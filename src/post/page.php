<?php
$title = 'Post';

$action = 'view';
$postId = null;
$post = array();
$postExists = false;

$postImgPath = '/img/posts/';
$postImgFullPath = '//' . $appHost . $postImgPath;
$postImgLocalPath = $phpDocRoot . $postImgPath;
$postImgMaxSizeBytes = 2000000;
$postImgMaxSizeName = '2 MB';
$postImgAllowedTypes = array('.jpg', '.jpeg', '.png', '.webp', '.gif', '.tif', '.tiff', '.bmp', '.bitmap');
$postImgInputAccept = implode(', ', $postImgAllowedTypes);

$image = null;
$imageExtension = null;
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
    if ($_FILES && $_FILES['image'] && $_FILES['image']['name'] && $_FILES['image']['error'] !== 4) {
        $isReplacingImage = true;
        $imageInfo = $_FILES['image'];
        $image = $imageInfo['tmp_name'];
        $imageSize = $imageInfo['size'];
        $imageError = $imageInfo['error'];
        $imageExtension = strtolower(pathinfo($imageInfo['name'])['extension']);
    } else if ($image !== null) {
        $isReplacingImage = false;
        $imageExtension = strtolower(pathinfo($image)['extension']);
    }
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
        if ($isReplacingImage === true) $image = null;
        $postError = 'Please add an image and a title.';
    } elseif (strlen($heading) > $headingMaxlength) {
        $headingClass = 'invalid';
        if ($isReplacingImage === true) $image = null;
        $postError = 'That title is too long.';
    } elseif (strlen($description) > $descriptionMaxlength) {
        $descriptionClass = 'invalid';
        if ($isReplacingImage === true) $image = null;
        $postError = 'That description is too long.';
    } elseif ($isReplacingImage === true && ($imageSize > $postImgMaxSizeBytes || $imageError === 1 || $imageError === 2)) {
        $imageClass = 'invalid';
        $image = null;
        $postError = 'That image is too big. The maximum allowed image file size is ' . $postImgMaxSizeName . '.';
    } elseif ($isReplacingImage === true && (!$imageExtension || !in_array('.' . $imageExtension, $postImgAllowedTypes))) {
        $imageClass = 'invalid';
        $image = null;
        $postError = 'That image does not have an allowed file type. The allowed files types are: ' . $postImgInputAccept;
    }

    // Create/edit post
    if ($postError === null) {
        if ($postAction === 'create') {

            $newPostId = dbGenId();
            if ($isReplacingImage === true) move_uploaded_file($image, $postImgLocalPath . $newPostId . '.' . $imageExtension);
            dbQuery("INSERT INTO `posts` (`id`, `heading`, `description`, `image`, `author`, `date_posted`, `status`) VALUES (?, ?, ?, ?, ?, NOW(), NULL)", array(
                $newPostId,
                $heading,
                $description,
                $newPostId . '.' . $imageExtension,
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
                if ($isReplacingImage === true) move_uploaded_file($image, $postImgLocalPath . $postId . '.' . $imageExtension);
                dbQuery("UPDATE `posts` SET `heading` = ?, `description` = ?, `image` = ? WHERE id = ?", array(
                    $heading,
                    $description,
                    $postId . '.' . $imageExtension,
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