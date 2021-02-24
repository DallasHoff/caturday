<?php
require $_SERVER['DOCUMENT_ROOT'] . '/App.php';

authDestroySession();

// Redirect back to previous page
if (!empty($_GET['return'])) {
    $uri = $_GET['return'];
    $uri = ltrim($uri, '/');
    header('Location: //' . $appHost . '/'. $uri);
    exit();
}
header('Location: /');
exit();