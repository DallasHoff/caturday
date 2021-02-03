<?php
$title = 'Log In';

$username = null;
$password = null;
$loginError = null;
$isAdminLogin = false;

$usernameClass = '';
$passwordClass = '';


// POST fields
if ($phpReqMethod === 'POST') {

    // Field values
    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    // Validation
    if (
        $username === null ||
        $password === null
    ) {
        $usernameClass = $username === null ? 'invalid' : '';
        $passwordClass = $password === null ? 'invalid' : '';
        $loginError = 'Please fill out both fields.';
    } elseif (
        strlen($username) > $usernameMaxlength
    ) {
        $usernameClass = 'invalid';
        $loginError = 'That username is too long.';
    }

    // Check username and password
    if ($loginError === null) {
        $userInfo = dbQuery("select password, is_admin from users where username=?", array($username));
        if (empty($userInfo)) {
            $loginError = 'Incorrect username or password.'; // username does not exist
            logAction('login_failure', array(
                'reason' => 'invalid username',
                'username' => $username
            ));
        } else {
            $passwordHash = $userInfo[0]['password'];
            $isAdminLogin = $userInfo[0]['is_admin'] === '1';
            if (!$passwordHash || password_verify($password, $passwordHash) !== true) {
                $loginError = 'Incorrect username or password.'; // incorrect password
                logAction('login_failure', array(
                    'reason' => 'incorrect password',
                    'username' => $username,
                    'is_admin' => $isAdminLogin ? '1' : '0'
                ));
            }
        }
    }

    // Log user in
    if ($loginError === null) {

        // Create session
        authCreateSession($username);

        // Log success
        logAction('login_success', array(
            'username' => $username,
            'is_admin' => $isAdminLogin ? '1' : '0'
        ));
        
        // Redirect
        if ($isAdminLogin) {
            header('Location: /admin/');
            exit();
        } else {
            header('Location: /');
            exit();
        }

    }

}