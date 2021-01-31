<?php require_once 'new-post-button.css.php'; ?>
<a href="<?= ($authIsLoggedIn) ? '/post/' : '/register/' ?>" class="new-post-button">
    <i class="far fa-plus"></i>
</a>