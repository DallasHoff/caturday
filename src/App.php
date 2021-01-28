<?php
// PHP globals
$phpDocRoot = $_SERVER['DOCUMENT_ROOT'];
$phpReqMethod = $_SERVER['REQUEST_METHOD'];
$phpUserIp = $_SERVER['REMOTE_ADDR'];
$phpUserPort = $_SERVER['REMOTE_PORT'];

// Database
require_once 'database.php';
require_once 'auth.php';
require_once 'logging.php';

// UI component function
function ui($component, $props) {
    extract($props);
    require $_SERVER['DOCUMENT_ROOT'] . '/_partials/' . $component . '.php';
}