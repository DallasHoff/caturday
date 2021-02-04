<?php
$path = $GLOBALS['phpReqPath'];
$authIsLoggedIn = $GLOBALS['authIsLoggedIn'];
$authUsername = $GLOBALS['authUsername'];
$phpReqUri = $GLOBALS['phpReqUri'];
?>
<nav class="header-inner">

    <a href="/" class="header-wordmark"><i class="fad fa-cat"></i> Caturday Night</a>

    <?php if ($authIsLoggedIn): ?>
    <ul class="nav-links">
        <li class="nav-link nav-link--home <?= ($path === '/') ? 'nav-link--current-page' : '' ?>">
            <a href="/">
                <i class="fad fa-house icon-left"></i>
                <span class="nav-link__label">Home</span>
            </a>
        </li>
        <li class="nav-link <?= ($path === '/profile/') ? 'nav-link--current-page' : '' ?>">
            <a href="/profile/?user=<?= urlencode(safe($authUsername)) ?>">
                <i class="fad fa-user-circle icon-left"></i>
                <span class="nav-link__label">Profile</span>
            </a>
        </li>
        <li class="nav-link <?= ($path === '/logout/') ? 'nav-link--current-page' : '' ?>">
            <a href="/logout/?return=<?= $phpReqUri ?>">
                <i class="fad fa-sign-out icon-left"></i>
                <span class="nav-link__label">Log Out</span>
            </a>
        </li>
    </ul>
    <?php else: ?>
    <ul class="nav-links">
        <li class="nav-link nav-link--home <?= ($path === '/') ? 'nav-link--current-page' : '' ?>">
            <a href="/">
                <i class="fad fa-house icon-left"></i>
                <span class="nav-link__label">Home</span>
            </a>
        </li>
        <li class="nav-link <?= ($path === '/register/') ? 'nav-link--current-page' : '' ?>">
            <a href="/register/">
                <i class="fad fa-user-plus fa-sm icon-left"></i>
                <span class="nav-link__label">Register</span>
            </a>
        </li>
        <li class="nav-link <?= ($path === '/login/') ? 'nav-link--current-page' : '' ?>">
            <a href="/login/">
                <i class="fad fa-sign-in icon-left"></i>
                <span class="nav-link__label">Log In</span>
            </a>
        </li>
    </ul>
    <?php endif; ?>

</nav>