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

            // Go to /login/?success=reset_password after reset
        }

    }

    // Stay on same step if there is an error
    if ($resetError !== null) {
        $action = !empty($_POST['prev_action']) ? $_POST['prev_action'] : 'initial';
    }

}
