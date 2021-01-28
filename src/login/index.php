<?php
require $_SERVER['DOCUMENT_ROOT'] . '/App.php';
require 'page.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ui('meta', ['title' => $title]); ?>
    <link rel="stylesheet" href="/css/auth.css">
</head>
<body>
	<?php ui('header', ['title' => $title]); ?>
	<main>
		<article>
			<section>
				<div class="login-form-header">
					<h2>Welcome Back!</h2>
					<p>New here? <a href="/register/">Register.</a></p>
				</div>
				<form method="POST" class="login-form">

					<label>Username
						<input type="text" name="username" value="<?= safe($username) ?>" maxlength="100" required>
					</label>
                    <div class="spacer"></div>
                    
					<label>Password
						<input type="password" name="password" value="<?= safe($password) ?>" required>
                    </label>
                    <a href="/reset-password/" class="login-field-link">Forgot Password?</a>
                    <div class="spacer"></div>
                    
					<?php if ($loginError): ?>
					<div class="warning-message">
						<p>Incorrect username or password.</p>
					</div>
					<div class="spacer"></div>
                    <?php endif; ?>
                    
					<div class="button-set">
						<button type="submit">Log In</button>
                    </div>
                    
				</form>
			</section>
		</article>
	</main>
	<?php ui('footer'); ?>
</body>
</html>
