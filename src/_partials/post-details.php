<?php 
require_once 'post-details.css.php';
uiScript('post-details');
$authUsername = $GLOBALS['authUsername'];
?>
<?php  ?>
<div class="post-details">

    <figure class="post-details__figure">
        <img src="/img/posts/<?= $image ?>" alt="" class="post-details__image">
    </figure>


    <div class="post-details__info">


        <?php if (!empty($description)): ?>
        <p class="post-details__description">
            <?= safe($description) ?>
        </p>
        <div class="spacer"></div>
        <?php endif; ?>

        <p class="post-details__date-posted" data-js-timestamp="<?= strtotime($date_posted) * 1000 ?>">
            <?= safe(date_format(date_create($date_posted), 'd F Y h:i:s A e')) ?>
        </p>
        <div class="spacer"></div>

        <?php if (!empty($author)): ?>
        <p class="post-details__author">
            Posted by <?= safe($author) ?>
        </p>
        <div class="spacer"></div>
        <a href="/profile/?user=<?= urlencode(safe($author)) ?>">
            <i class="fad fa-user-circle icon-left"></i>
            More from <?= safe($author) ?>
        </a>
        <?php endif; ?>

        <div class="spacer"></div>
        <div class="spacer"></div>
        <?php ui('share-buttons') ?>
        <div class="spacer"></div>
        <div class="spacer"></div>

        <?php if (!empty($author) && $author === $authUsername): ?>
        <div class="button-set button-set--row">
            <a class="button post-details__edit" href="?id=<?= safe($id) ?>&action=edit" title="Edit this post">
                <i class="fad fa-edit icon-left"></i>
                Edit
            </a>
            <a class="button button-secondary post-details__delete" href="?id=<?= safe($id) ?>&action=delete" title="Delete this post">
                <i class="fad fa-trash-alt icon-left"></i>
                Delete
            </a>
        </div>
        <?php endif; ?>

    </div>

</div>