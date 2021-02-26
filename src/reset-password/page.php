<?php
$title = 'Reset Password';

$action = 'initial';
$username = null;
$securityQuestion = null;
$securityAnswer = null;
$newPassword = null;
$resetError = null;

$usernameClass = '';
$newPasswordClass = '';
$securityAnswerClass = '';


if ($phpReqMethod === 'POST') {

    // Field values
    $action = !empty($_POST['action']) ? $_POST['action'] : null;
    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $securityAnswer = !empty($_POST['security_answer']) ? $_POST['security_answer'] : null;
    $newPassword = !empty($_POST['new_password']) ? $_POST['new_password'] : null;

    // Validation
    if (
        $action === null ||
        $username === null ||
        ($action === 'reset_password' && $newPassword === null) ||
        ($action === 'reset_password' && $securityAnswer === null)
    ) {
        $usernameClass = $username === null ? 'invalid' : '';
        $newPasswordClass = $newPassword === null ? 'invalid' : '';
        $securityAnswerClass = $securityAnswer === null ? 'invalid' : '';
        $resetError = 'Please fill out all the fields.';
    } elseif (
        strlen($username) > $usernameMaxlength
    ) {
        $usernameClass = 'invalid';
        $resetError = 'That username is too long.';
    }

    // Action
    if ($resetError === null) {

        switch ($action) {

            case 'get_question':
                $userInfo = dbQuery("select security_question, is_admin from users where username=?", array($username));
                if (empty($userInfo)) {
                    // User exists check
                    $resetError = 'That username does not exist. Please check your input.';
                    logAction('get_security_question_failure', array(
                        'reason' => 'invalid username',
                        'username' => $username
                    ));
                } else {
                    // Display security question
                    $securityQuestion = $userInfo[0]['security_question'];
                    $isAdmin = $userInfo[0]['is_admin'] === 1;
                    logAction('got_security_question', array(
                        'username' => $username,
                        'is_admin' => $isAdmin ? '1' : '0'
                    ));
                }
                break;

            case 'reset_password':
                $userInfo = dbQuery("select security_question, security_answer, is_admin, is_locked from users where username=?", array($username));
                if (empty($userInfo)) {
                    // User exists check
                    $resetError = 'That username does not exist. Please check your input.';
                    logAction('reset_password_failure', array(
                        'reason' => 'invalid username',
                        'username' => $username
                    ));
                } else {
                    $securityQuestion = $userInfo[0]['security_question'];
                    $securityAnswerHash = $userInfo[0]['security_answer'];
                    $isAdmin = $userInfo[0]['is_admin'] === 1;
                    $isLocked = $userInfo[0]['is_locked'] === 1;
                    if (password_verify($securityAnswer, $securityAnswerHash) !== true) {
                        // Answer check
                        $resetError = 'Your answer to the security question was incorrect. Please check your input.';
                        logAction('reset_password_failure', array(
                            'reason' => 'incorrect security answer',
                            'username' => $username,
                            'is_admin' => $isAdmin ? '1' : '0'
                        ));
                    } else if ($isLocked === true) {
                        // User is locked
                        $resetError = 'Your account has been locked. If you think this was done in error, please contact us.';
                        logAction('reset_password_failure', array(
                            'reason' => 'user locked',
                            'username' => $username,
                            'is_admin' => $isAdmin ? '1' : '0'
                        ));
                    } else {
                        // Change password
                        try {
                            $newPasswordHash = password_hash($newPassword, PASSWORD_DEFAULT);
                            dbQuery("update users set password=? where username=?", array(
                                $newPasswordHash,
                                $username
                            ));
                            logAction('reset_password_success', array(
                                'username' => $username,
                                'is_admin' => $isAdmin ? '1' : '0'
                            ));
                            // Redirect on success
                            header('Location: /login/?success=reset_password');
                            exit();
                        } catch (Throwable $e) {
                            $resetError = 'Oops, an error occurred. Please try again.';
                            logAction('reset_password_failure', array(
                                'reason' => 'password update error',
                                'username' => $username,
                                'is_admin' => $isAdmin ? '1' : '0'
                            ));
                        }
                    }
                }
                break;

        }

    }

    // Stay on same step if there is an error
    if ($resetError !== null) {
        $action = !empty($_POST['prev_action']) ? $_POST['prev_action'] : 'initial';
    }

}
