<?php
$title = 'Post';
$postImgPath = '//' . $appHost . '/img/posts/';

$action = 'view';
$postId = null;
$post = array();
$postExists = false;

$image = null;
$heading = null;
$description = null;
$headingMaxlength = 100;
$descriptionMaxlength = 400;
$imageClass = '';
$headingClass = '';
$descriptionClass = '';
$postError = null;


function viewPost($postId) {
    global $action;
    global $post;
    global $postExists;
    global $title;
    $action = 'view';
    $post = dbQuery("select * from posts where id=?", array($postId))[0];
    $postExists = !empty($post);
    $title = safe($post['heading']);
}


if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    if (
        $authIsLoggedIn && 
        isset($_GET['action']) && 
        ($_GET['action'] === 'edit' || $_GET['action'] === 'delete')
    ) {
        // Editing or deleting a post
        $action = $_GET['action'];
        $post = dbQuery("select * from posts where id=?", array($postId));
        if (empty($post) || ($post[0]['author'] !== $authUsername && $authIsAdmin !== true)) {
            viewPost($postId);
        } else if ($action === 'edit') {
            $image = $post[0]['image'];
            $heading = $post[0]['heading'];
            $description = $post[0]['description'];
        } else if ($action === 'delete') {
            dbQuery("DELETE FROM `posts` WHERE id=?", array($postId));
            logAction('post_deleted', array(
                'post_id' => $postId
            ));
            header('Location: /profile/?user=' . urlencode($authUsername));
            exit();
        }
    } else {
        viewPost($postId);
    }
} else if ($authIsLoggedIn) {
    // Making new post
    $action = 'create';
}


if ($phpReqMethod === 'POST' && $authIsLoggedIn) {

    // Field values
    if (!empty($_POST['image'])) $image = true;
    $heading = !empty($_POST['heading']) ? $_POST['heading'] : null;
    $description = !empty($_POST['description']) ? $_POST['description'] : null;
    $postAction = !empty($_POST['action']) ? $_POST['action'] : null;

    // Validation
    if (
        $image === null ||
        $heading === null ||
        $postAction === null
    ) {
        $imageClass = $image === null ? 'invalid' : '';
        $headingClass = $heading === null ? 'invalid' : '';
        $postError = 'Please add an image and a title.';
    } elseif (
        strlen($heading) > $headingMaxlength
    ) {
        $headingClass = 'invalid';
        $postError = 'That title is too long.';
    } elseif (
        strlen($description) > $descriptionMaxlength
    ) {
        $descriptionClass = 'invalid';
        $postError = 'That description is too long.';
    }
    // TODO check image

    // Create/edit post
    if ($postError === null) {
        if ($postAction === 'create') {

            $newPostId = dbGenId();
            dbQuery("INSERT INTO `posts` (`id`, `heading`, `description`, `image`, `author`, `date_posted`, `status`) VALUES (?, ?, ?, ?, ?, NOW(), NULL)", array(
                $newPostId,
                $heading,
                $description,
                rand(0, 3) . '.jpg', // TODO use uploaded image
                $authUsername
            ));
            logAction('post_created', array(
                'post_id' => $newPostId
            ));
            header('Location: /post/?id=' . $newPostId);
            exit();

        } else if ($postAction === 'edit') {

            $post = dbQuery("select * from posts where id=?", array($postId));
            if (!empty($post) && ($post[0]['author'] === $authUsername || $authIsAdmin === true)) {
                dbQuery("UPDATE `posts` SET `heading` = ?, `description` = ?, `image` = ? WHERE id = ?", array(
                    $heading,
                    $description,
                    rand(0, 3) . '.jpg', // TODO use uploaded image
                    $postId
                ));
                logAction('post_edited', array(
                    'post_id' => $postId
                ));
            }
            header('Location: /post/?id=' . $postId);
            exit();

        }
    }
    
}