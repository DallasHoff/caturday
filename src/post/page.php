<?php
$title = 'Post';

$postId = null;
$post = array();
$postExists = false;

if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    $post = dbQuery("select * from posts where id=?", array($postId))[0];
    $postExists = !empty($post);
}

if ($postExists === true) {
    $title = safe($post['heading']);
}