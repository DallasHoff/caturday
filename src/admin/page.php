<?php
$title = 'Admin Dashboard';

// Restrict access
if ($authIsAdmin !== true) {
    http_response_code(403);
    exit();
}

// User management
$columns = array(
    'username' => 'Username',
    'date_joined' => 'Joined',
    'is_admin' => 'Admin',
    'is_blocked' => 'Blocked'
);

$order = $_GET['order'];
$userListOrder = array_key_exists($order, $columns) ? $order : 'username';

$limit = intval($_GET['limit']);
$userListLimit = $limit > 0 ? $limit : 50;

$userList = dbQuery("select username, date_joined, is_admin, is_blocked from users order by $userListOrder asc limit ?", array($userListLimit));

// Actions
// TODO