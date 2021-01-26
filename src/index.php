<?php
require $_SERVER['DOCUMENT_ROOT'] . '/App.php';
require 'home.php';
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
				<h2>Recent Posts</h2>
				<?php ui('card-gallery', ['cards' => $posts]); ?>
			</section>
			<?php ui('new-post-button'); ?>
		</article>
	</main>
	<?php ui('footer'); ?>
</body>
</html>
