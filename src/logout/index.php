<?php
require $_SERVER['DOCUMENT_ROOT'] . '/App.php';
authDestroySession();
header('Location: /'); // TODO redirect back to previous page using uri saved in query string