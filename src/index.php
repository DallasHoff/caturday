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
	<div id="app">
		<?php ui('header', ['title' => $title]); ?>
		<main>
			<article class="transition-page">
				<section>
					<h2>Recent Posts</h2>
					<?php ui('card-gallery', ['cards' => $posts]); ?>
				</section>
			</article>
			<?php ui('new-post-button'); ?>
		</main>
		<?php ui('footer'); ?>
	</div>
</body>
</html>
