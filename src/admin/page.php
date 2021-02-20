<?php
$title = 'Admin Dashboard';

// Restrict access
if ($authIsAdmin !== true) {
    http_response_code(403);
    exit();
}

// User management actions
if ($phpReqMethod === 'POST' && !empty($_POST['target_user']) && !empty($_POST['action'])) {

    $targetUser = $_POST['target_user'];
    $action = $_POST['action'];

    switch ($action) {

        case 'lock':
            dbQuery("delete from sessions where username=?", array($targetUser));
            dbQuery("update users set is_locked=1 where username=?", array($targetUser));
            break;

        case 'unlock':
            dbQuery("update users set is_locked=0 where username=?", array($targetUser));
            break;

        case 'signout':
            dbQuery("delete from sessions where username=?", array($targetUser));
            break;

        case 'promote':
            dbQuery("update users set is_admin=1 where username=?", array($targetUser));
            break;

        case 'demote':
            dbQuery("update users set is_admin=0 where username=?", array($targetUser));
            break;

        case 'delete':
            dbQuery("delete from sessions where username=?", array($targetUser));
            dbQuery("delete from posts where author=?", array($targetUser));
            dbQuery("delete from users where username=?", array($targetUser));
            break;

    }

}

// Fetch user list
$columns = array(
    'username' => 'Username',
    'date_joined' => 'Date Joined',
    'is_admin' => 'Is Admin',
    'is_locked' => 'Is Locked',
    'logged_in' => 'Is Logged In'
);

$limits = array(25, 50, 100, 200, 500);

$order = $_GET['order'];
$userListOrder = array_key_exists($order, $columns) ? $order : 'username';
$userListOrderDir = $userListOrder === 'username' ? 'asc' : 'desc';

$limit = intval($_GET['limit']);
$userListLimit = $limit > 0 ? $limit : 50;

$searchUsername = $_GET['search'];

$userList = dbQuery("
    select u.username, u.date_joined, u.is_admin, u.is_locked, (s.expires > NOW()) as logged_in
    from users u 
    left join sessions s 
    on u.username = s.username 
    where u.username like ? 
    order by $userListOrder $userListOrderDir 
    limit ?
", array('%' . $searchUsername . '%', $userListLimit));