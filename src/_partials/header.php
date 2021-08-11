<header>

    <?php ui('nav', ['title' => $title]); ?>

    <div class="header-stripe"></div>

    <?php if ($hideHero !== true): ?>
    <div class="header-hero">
        <h1 class="header-hero__heading"><?= safe($title) ?></h1>
    </div>
    <?php endif; ?>

</header>