<?php
require_once 'new-post-button.css.php';
$authIsLoggedIn = $GLOBALS['authIsLoggedIn'];
?>
<a href="<?= ($authIsLoggedIn) ? '/post/' : '/register/' ?>" class="new-post-button" title="Make a post">
    <i class="far fa-plus"></i>
</a>