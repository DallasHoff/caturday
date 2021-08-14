<?php
require $_SERVER['DOCUMENT_ROOT'] . '/App.php';
require 'page.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ui('meta', [
        'title' => $title, 
        'author' => ($action === 'view') ? $post['author'] : '', 
        'description' => ($action === 'view') ? $post['description'] : ''
    ]); ?>
    <link rel="stylesheet" href="/post/page.css">
	<script defer src="/js/form-validity.js"></script>
	<script defer src="/js/local-timestamps.js"></script>
    <script defer src="/post/page.js"></script>
</head>
<body>
	<div id="app">
        <?php ui('header', ['title' => $title, 'hideHero' => true]); ?>
        <main>
            <article class="transition-page">

                <?php if ($action === 'create' || $action === 'edit'): ?>
                <section>
                    <?php if ($action === 'create'): ?>
                    <h2>Create New Post</h2>
                    <?php elseif ($action === 'edit'): ?>
                    <h2>Edit Post</h2>
                    <?php endif; ?>

                    <form method="POST" class="edit-post" enctype="multipart/form-data">

                        <figure class="edit-post__figure <?= safe($image) && $image !== true ? 'edit-post__figure--show-image' : '' ?>" title="Post image">
                            <div class="edit-post__figure-inner">
                                <i class="fad fa-image edit-post__figure-icon"></i>
                                <input 
                                type="file" 
                                accept="<?= $postImgInputAccept ?>" 
                                name="image" 
                                <?= ($action === 'create') ? 'required' : '' ?> 
                                class="edit-post__image-input <?= $imageClass ?>" 
                                aria-label="Post image"
                                >
                            </div>
                            <img src="<?= safe($image) && $image !== true ?  $postImgFullPath . safe($image) : '' ?>" alt="" class="edit-post__image">
                            <button type="button" class="edit-post__image-remove-btn plain-button">
                                <i class="fad fa-times-square icon-left"></i> 
                                Replace
                            </button>
                        </figure>

                        <div class="edit-post__info">

                            <label>Title
                                <input 
                                type="text" 
                                name="heading" 
                                value="<?= safe($heading) ?>" 
                                maxlength="<?= $headingMaxlength ?>" 
                                required
                                class="<?= $headingClass ?>"
                                >
                            </label>
                            <div class="spacer"></div>

                            <label>Description
                                <textarea 
                                name="description" 
                                rows="6" 
                                maxlength="<?= $descriptionMaxlength ?>" 
                                class="<?= $descriptionClass ?>"
                                ><?= safe($description) ?></textarea>
                            </label>
                            <div class="spacer"></div>

                            <input type="hidden" name="action" value="<?= safe($action) ?>">
                                
                            <?php if ($postError): ?>
                            <div class="warning-message">
                                <p><?= $postError ?></p>
                            </div>
                            <div class="spacer"></div>
                            <?php endif; ?>

                            <div class="button-set">
                                <button type="submit">Post</button>
                            </div>

                        </div>

                    </form>
                </section>
                <?php else: ?>
                <section>

                    <?php if ($postId === null): ?>
                    <h2>Bad Request</h2>
                    <?php elseif ($postExists === true): ?>
                    <h2><?= safe($title) ?></h2>
                    <?php else: ?>
                    <h2>Post Not Found</h2>
                    <?php endif; ?>

                    <?php if ($postId === null): ?>
                    <p>No post was specified.</p>
                    <?php elseif ($postExists === true): ?>
                    <?php ui('post-details', $post); ?>
                    <?php else: ?>
                    <p>This post does not exist.</p>
                    <?php endif; ?>
                
                </section>
                <?php endif; ?>

            </article>
        </main>
        <?php ui('footer'); ?>
    </div>
</body>
</html>
