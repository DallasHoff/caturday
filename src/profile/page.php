<?php
$title = 'User Profile';

$username = null;
$userExists = false;
$posts = array();
$userHasPosts = false;

if (isset($_GET['user'])) {
    $username = $_GET['user'];
    $title = safe($username);
    $userExists = !empty(dbQuery("select username from users where username=?", array($username)));
}

if ($userExists === true) {
    $posts = dbQuery("select * from posts where author=? order by date_posted desc limit 24", array($username));
    $userHasPosts = !empty($posts);
}
