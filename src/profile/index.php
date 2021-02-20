<?php
require $_SERVER['DOCUMENT_ROOT'] . '/App.php';
require 'page.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ui('meta', ['title' => $title]); ?>
</head>
<body>
	<?php ui('header', ['title' => $title]); ?>
	<main>
		<article>
			<section>

                <?php if ($username === null): ?>
                <h2>Bad Request</h2>
                <?php elseif ($userExists === true): ?>
                <h2>Posts by <?= safe($username) ?></h2>
                <?php if ($authIsAdmin === true): ?>
                <a href="/admin/?search=<?= urlencode(safe($username)) ?>">
                    <i class="fad fa-crown icon-left"></i>
                    View User on Admin Dashboard
                </a>
                <div class="spacer"></div>
                <?php endif; ?>
                <?php else: ?>
                <h2><?= safe($username) ?> Was Not Found</h2>
                <?php endif; ?>
                
                <?php if ($username === null): ?>
                <p>No username was specified.</p>
                <?php elseif ($userExists === true && $userHasPosts === true): ?>
                <?php ui('card-gallery', ['cards' => $posts]); ?>
                <?php elseif ($userExists === true && $userHasPosts === false): ?>
                <p>This user has not made any posts yet.</p>
                <?php else: ?>
                <p>This user does not exist.</p>
                <?php endif; ?>

			</section>
		</article>
	</main>
	<?php ui('footer'); ?>
</body>
</html>
