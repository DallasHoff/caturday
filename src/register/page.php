<?php
$title = 'Register';

$username = null;
$password = null;
$securityQuestion = null;
$securityAnswer = null;
$pagePosted = false;
$nameExists = null;
$registerError = null;

$usernameMaxlength = 100;
$securityQuestionMaxlength = 400;

$usernameClass = '';
$passwordClass = '';
$securityQuestionClass = '';
$securityAnswerClass = '';

// POST fields
if ($phpReqMethod === 'POST') {
    $pagePosted = true;
    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;
    $securityQuestion = !empty($_POST['security_question']) ? $_POST['security_question'] : null;
    $securityAnswer = !empty($_POST['security_answer']) ? $_POST['security_answer'] : null;
}

// Validation
if (
    $pagePosted === true && 
    (
        $username === null || 
        $password === null || 
        $securityQuestion === null || 
        $securityAnswer === null
    )
) {
    $usernameClass = $username === null ? 'invalid' : '';
    $passwordClass = $password === null ? 'invalid' : '';
    $securityQuestionClass = $securityQuestion === null ? 'invalid' : '';
    $securityAnswerClass = $securityAnswer === null ? 'invalid' : '';
    $registerError = 'Please fill out all the fields.';
} else if (
    $pagePosted === true && 
    (
        strlen($username) > $usernameMaxlength || 
        strlen($securityQuestionClass) > $securityQuestionMaxlength
    )
) {
    $usernameClass = strlen($username) > $usernameMaxlength ? 'invalid' : '';
    $securityQuestionClass = strlen($securityQuestionClass) > $securityQuestionMaxlength ? 'invalid' : '';
    $registerError = 'One or more of your inputs was too long.';
} else if (
    $pagePosted === true && 
    count(dbQuery("select username from users where username=?", array($username))) !== 0
) {
    $registerError = 'Sorry, that username is already in use.';
}

// Register user
if ($pagePosted === true && $registerError === null) {
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);
    $securityAnswerHash = password_hash($securityAnswer, PASSWORD_DEFAULT);
    try {
        dbQuery("INSERT INTO `users` (`username`, `password`, `security_question`, `security_answer`, `date_joined`, `is_admin`) VALUES (?, ?, ?, ?, NOW(), b'0')", array(
            $username,
            $passwordHash,
            $securityQuestion,
            $securityAnswerHash
        ));
        header('Location: /');
        exit();
    } catch (Throwable $e) {
        $registerError = 'Oops, an error occurred. Please try again.';
    }
}

// TODO log user in after registering