<?php
$title = 'Register';

$username = null;
$password = null;
$securityQuestion = null;
$securityAnswer = null;
$nameExists = null;
$registerError = null;

$usernameClass = '';
$passwordClass = '';
$securityQuestionClass = '';
$securityAnswerClass = '';


// POST fields
if ($phpReqMethod === 'POST') {

    // Field values
    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;
    $securityQuestion = !empty($_POST['security_question']) ? $_POST['security_question'] : null;
    $securityAnswer = !empty($_POST['security_answer']) ? $_POST['security_answer'] : null;

    // Validation
    if (
        $username === null ||
        $password === null ||
        $securityQuestion === null ||
        $securityAnswer === null
    ) {
        $usernameClass = $username === null ? 'invalid' : '';
        $passwordClass = $password === null ? 'invalid' : '';
        $securityQuestionClass = $securityQuestion === null ? 'invalid' : '';
        $securityAnswerClass = $securityAnswer === null ? 'invalid' : '';
        $registerError = 'Please fill out all the fields.';
    } elseif (
        strlen($username) > $usernameMaxlength ||
        strlen($securityQuestionClass) > $securityQuestionMaxlength
    ) {
        $usernameClass = strlen($username) > $usernameMaxlength ? 'invalid' : '';
        $securityQuestionClass = strlen($securityQuestionClass) > $securityQuestionMaxlength ? 'invalid' : '';
        $registerError = 'One or more of your inputs was too long.';
    } elseif (
        count(dbQuery("select username from users where username=?", array($username))) !== 0
    ) {
        $registerError = 'Sorry, that username is already in use.';
        logAction('register_failure', array(
            'reason' => 'taken username',
            'username' => $username
        ));
    }

    // Register user
    if ($registerError === null) {
        try {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $securityAnswerHash = password_hash($securityAnswer, PASSWORD_DEFAULT);
            dbQuery("INSERT INTO `users` (`username`, `password`, `security_question`, `security_answer`, `date_joined`, `is_admin`) VALUES (?, ?, ?, ?, NOW(), b'0')", array(
                $username,
                $passwordHash,
                $securityQuestion,
                $securityAnswerHash
            ));
        } catch (Throwable $e) {
            $registerError = 'Oops, an error occurred. Please try again.';
            logAction('register_failure', array(
                'reason' => 'insert error',
                'username' => $username
            ));
        }
    }

    // Log user in
    if ($registerError === null) {

        // Create session
        // TODO

        // Log success
        logAction('register_success', array(
            'username' => $username
        ));
        
        // Redirect
        header('Location: /');
        exit();
        
    }

}