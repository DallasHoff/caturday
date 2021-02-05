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
    $action = 'view';
    global $post;
    $post = dbQuery("select * from posts where id=?", array($postId))[0];
    global $postExists;
    $postExists = !empty($post);
    global $title;
    $title = safe($post['heading']);
}


if (isset($_GET['id'])) {
    $postId = $_GET['id'];
    if ($authIsLoggedIn) {
        if (isset($_GET['action']) && $_GET['action'] === 'edit') {
            // Editing a post
            $action = 'edit';
            $post = dbQuery("select * from posts where id=? and author=?", array(
                $postId,
                $authUsername
            ));
            if (empty($post)) {
                viewPost($postId);
            } else {
                $image = $post[0]['image'];
                $heading = $post[0]['heading'];
                $description = $post[0]['description'];
            }
        } else {
            viewPost($postId);
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
        // TODO
    }
    
}