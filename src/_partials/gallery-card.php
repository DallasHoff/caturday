<?php require_once 'gallery-card.css.php'; ?>
<li class="gallery-card">
    <a href="/post/?id=<?= $id ?>" class="gallery-card__link">

        <figure class="gallery-card__figure">
            <img src="/img/posts/<?= $image ?>" alt="" class="gallery-card__image" loading="lazy">
        </figure>


        <div class="gallery-card__body">


            <?php if (!empty($heading) && !empty($author)): ?>
            <h3><?= htmlentities($heading) ?></h3>
            <div class="gallery-card__author"><?= htmlentities($author) ?></div>

            <?php elseif (empty($heading) && !empty($author)): ?>
            <h3><?= 'Post by ' . htmlentities($author) ?></h3>
            <div class="gallery-card__author"><?= htmlentities($author) ?></div>

            <?php elseif (!empty($heading) && empty($author)): ?>
            <h3><?= htmlentities($heading) ?></h3>
            <div class="gallery-card__author">A User</div>

            <?php else: ?>
            <h3>Post by a User</h3>
            <div class="gallery-card__author">A User</div>
            <?php endif; ?>
            

            <?php if (!empty($description)): ?>
            <p class="gallery-card__description"><?= htmlentities($description) ?></p>
            <?php endif; ?>


        </div>

    </a>
</li>