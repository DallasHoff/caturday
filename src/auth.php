<?php
// Auth info
$authIsLoggedIn = false;
$authUsername = null;
$authIsAdmin = false;

// Settings
$daysUntilSessionExpiry = 60;
$usernameMaxlength = 64;
$securityQuestionMaxlength = 400;

// Session functions
function authDestroySession() {
    global $appHost;
    global $authIsLoggedIn;
    global $authUsername;
    global $authIsAdmin;

    $cookie = $_COOKIE['appSession'];

    if (!empty($cookie)) {
        dbQuery("DELETE FROM `sessions` WHERE token=?", array($cookie));
        setcookie('appSession', '', time() - (3600 * 24 * 7), '/', $appHost, true, true);

        logAction('auth_session_destroyed', array(
            'username' => $authUsername,
            'is_admin' => $authIsAdmin ? '1' : '0'
        ));
        
        $authIsLoggedIn = false;
        $authUsername = null;
        $authIsAdmin = false;
    }
}

function authCreateSession($username) {
    global $appHost;
    global $daysUntilSessionExpiry;

    authDestroySession();
    $token = dbGenToken() . '-' . $username;

    setcookie('appSession', $token, time() + (3600 * 24 * $daysUntilSessionExpiry), '/', $appHost, true, true);

    dbQuery("INSERT INTO `sessions` (`session_id`, `username`, `token`, `expires`) VALUES (?, ?, ?, NOW() + INTERVAL ? DAY)", array(
        dbGenId(),
        $username,
        $token,
        $daysUntilSessionExpiry
    ));

    logAction('auth_session_created', array(
        'username' => $username
    ));
}

function authCheckSession() {
    global $authIsLoggedIn;
    global $authUsername;
    global $authIsAdmin;

    $session = null;
    $cookie = $_COOKIE['appSession'];
    $cookieInfo = explode('-', $cookie, 2);
    $username = $cookieInfo[1];

    if (!empty($cookie) && !empty($username)) {
        $session = dbQuery("select session_id from sessions where username=? and token=? and expires > NOW()", array(
            $username,
            $cookie
        ));
    }

    if (!empty($session)) {
        $authIsLoggedIn = true;
        $authUsername = $username;

        $isAdmin = dbQuery("select is_admin from users where username=?", array($username))[0]['is_admin'] === 1;
        if ($isAdmin === true) {
            $authIsAdmin = true;
        }

        logAction('auth_session_verified', array(
            'username' => $username,
            'is_admin' => $isAdmin ? '1' : '0'
        ));
    }
}