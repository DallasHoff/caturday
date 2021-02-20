<?php
require $_SERVER['DOCUMENT_ROOT'] . '/App.php';

$adminLogout = $authIsAdmin;
authDestroySession();

// Redirect back to previous page
if (!empty($_GET['return']) && !$adminLogout) {
    $uri = $_GET['return'];
    $uri = ltrim($uri, '/');
    header('Location: //' . $appHost . '/'. $uri);
    exit();
}
header('Location: /');
exit();