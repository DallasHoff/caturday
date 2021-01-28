<?php
// PHP globals
$phpDocRoot = $_SERVER['DOCUMENT_ROOT'];
$phpReqUri = $_SERVER['REQUEST_URI'];
$phpReqPath = strtok($phpReqUri, '?');
$phpReqMethod = $_SERVER['REQUEST_METHOD'];
$phpUserIp = $_SERVER['REMOTE_ADDR'];
$phpUserPort = $_SERVER['REMOTE_PORT'];

// Database
require_once 'database.php';
require_once 'auth.php';
require_once 'logging.php';

// UI components
function ui($component, $props) {
    extract($props);
    require $_SERVER['DOCUMENT_ROOT'] . '/_partials/' . $component . '.php';
}

// Sanitize text to be displayed
function safe($text) {
    return htmlentities($text);
}