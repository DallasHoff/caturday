<?php require_once 'post-details.css.php'; ?>
<div class="post-details">
    <figure class="post-details__figure">
        <img src="/img/posts/<?= $image ?>" alt="" class="post-details__image">
    </figure>
    <div class="post-details__info">
        <p class="post-details__description"><?= safe($description) ?></p>
        <div class="spacer"></div>
        <p class="post-details__date-posted"><?= safe(date_format(date_create($date_posted), 'd F Y H:i:s e')) ?></p>
        <div class="spacer"></div>
        <p class="post-details__author">Posted by <?= safe($author) ?></p>
    </div>
</div>