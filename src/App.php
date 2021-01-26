<?php
// PHP settings and information
$docRoot = $_SERVER['DOCUMENT_ROOT'];
date_default_timezone_set('America/New_York');

// Session
session_start();
$isLoggedIn = isset($_SESSION['username']);
$username = $isLoggedIn ? $_SESSION['username'] : null;
$isAdmin = isset($_SESSION['isAdmin']);

// Database connection and action logging
require_once 'database.php';
require_once 'logging.php';

// UI component function
function ui($component, $props) {
    extract($props);
    require $_SERVER['DOCUMENT_ROOT'] . '/_partials/' . $component . '.php';
}