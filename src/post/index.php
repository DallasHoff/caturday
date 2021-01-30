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
	<?php ui('header', ['title' => $title, 'hideHero' => true]); ?>
	<main>
		<article>
			<section>

                <?php if ($postId === null): ?>
                <h2>Bad Request</h2>
                <?php elseif ($postExists === true): ?>
                <h2><?= safe($title) ?></h2>
                <?php else: ?>
                <h2>Post Not Found</h2>
                <?php endif; ?>

                <?php if ($postId === null): ?>
                <p>No post was specified.</p>
                <?php elseif ($postExists === true): ?>
                <?php ui('post-details', $post); ?>
                <?php else: ?>
                <p>This post does not exist.</p>
                <?php endif; ?>

			</section>
		</article>
	</main>
	<?php ui('footer'); ?>
</body>
</html>
