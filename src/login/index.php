<?php
require $_SERVER['DOCUMENT_ROOT'] . '/App.php';
require 'page.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ui('meta', ['title' => $title]); ?>
    <link rel="stylesheet" href="/css/auth.css">
	<script defer src="/js/form-validity.js"></script>
</head>
<body>
	<div id="app">
		<?php ui('header', ['title' => $title]); ?>
		<main>
			<article class="transition-page">
				<section>
				
					<div class="login-form-header">

						<?php if (!empty($successMessage)): ?>
						<div class="success-message">
							<p><?= $successMessage ?></p>
						</div>
						<?php endif; ?>

						<h2>Welcome Back!</h2>
						<p>New here? <a href="/register/">Register.</a></p>

					</div>

					<form method="POST" class="login-form">

						<label>Username
							<input 
							type="text" 
							name="username" 
							value="<?= safe($username) ?>" 
							maxlength="<?= $usernameMaxlength ?>" 
							required
							class="<?= $usernameClass ?>"
							>
						</label>
						<div class="spacer"></div>
						
						<label>Password
							<input 
							type="password" 
							name="password" 
							value="<?= safe($password) ?>" 
							required
							class="<?= $passwordClass ?>"
							>
						</label>
						<a href="/reset-password/" class="login-field-link">Forgot Password?</a>
						<div class="spacer"></div>
						
						<?php if ($loginError): ?>
						<div class="warning-message">
							<p><?= $loginError ?></p>
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
	</div>
</body>
</html>
