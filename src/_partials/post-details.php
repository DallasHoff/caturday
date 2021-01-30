<?php require_once 'post-details.css.php'; ?>
<?php uiScript('post-details'); ?>
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


    </div>

</div>