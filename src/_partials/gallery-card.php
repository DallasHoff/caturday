<?php 
require_once 'gallery-card.css.php';
$postLink = '/post/?id=' . safe($id);
$authorLink = '/profile/?user=' . urlencode(safe($author));
?>
<li class="gallery-card">

    <a href="<?= $postLink ?>" class="gallery-card__link">
        <figure class="gallery-card__figure">
            <img src="/img/posts/<?= $image ?>" alt="" class="gallery-card__image" loading="lazy">
        </figure>
    </a>


    <div class="gallery-card__body">


        <?php if (!empty($heading) && !empty($author)): ?>
        <h3 class="gallery-card__heading">
            <a href="<?= $postLink ?>"><?= safe($heading) ?></a>
        </h3>
        <div class="gallery-card__author">
            <a href="<?= $authorLink ?>"><?= safe($author) ?></a>
        </div>

        <?php elseif (empty($heading) && !empty($author)): ?>
        <h3 class="gallery-card__heading">
            <a href="<?= $postLink ?>"><?= 'Post by ' . safe($author) ?></a>
        </h3>
        <div class="gallery-card__author">
            <a href="<?= $authorLink ?>"><?= safe($author) ?></a>
        </div>

        <?php elseif (!empty($heading) && empty($author)): ?>
        <h3 class="gallery-card__heading">
            <a href="<?= $postLink ?>"><?= safe($heading) ?></a>
        </h3>
        <div class="gallery-card__author">A User</div>

        <?php else: ?>
        <h3 class="gallery-card__heading">
            <a href="<?= $postLink ?>">Post by a User</a>
        </h3>
        <div class="gallery-card__author">A User</div>
        <?php endif; ?>
        

        <?php if (!empty($description)): ?>
        <p class="gallery-card__description"><?= safe($description) ?></p>
        <?php endif; ?>


    </div>

</li>