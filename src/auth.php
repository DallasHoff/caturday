<?php
// Auth info
$authIsLoggedIn = false;
$authUsername = null;
$authIsAdmin = false;

// Settings
$usernameMaxlength = 100;
$securityQuestionMaxlength = 400;

// Session functions
function authDestroySession() {
    // TODO
    // clear cookie
    // delete db row
    // log
    return null;
}

function authCreateSession($username) {
    // TODO
    // destroy existing session
    // generate token
    // store in cookies
    // store in db
    // log
    return null;
}

function authCheckSession() {
    // TODO
    // check token against db
    // set auth info
    // log
    return null;
}