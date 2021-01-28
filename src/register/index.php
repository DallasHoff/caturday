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
			        <h2>Join Caturday Night!</h2>
					<p>Already have an account? <a href="/login/">Log In.</a></p>
				</div>
				<form method="POST" class="login-form">
                    
					<label>Choose a Username
						<input type="text" name="username" value="<?= safe($username) ?>" maxlength="100" required>
					</label>
                    <div class="spacer"></div>
                    
					<label>Choose a Strong Password
						<input type="password" name="password" value="<?= safe($password) ?>" required>
                    </label>
                    <div class="spacer"></div>
                    
					<label>Choose a Security Question
                        <textarea name="security_question" value="<?= safe($securityQuestion) ?>" rows="3" maxlength="400" required></textarea>
					</label>
                    <div class="spacer"></div>
                    
					<label>Security Question Answer
						<input type="text" name="security_answer" value="<?= safe($securityAnswer) ?>" maxlength="200" required>
					</label>
                    <div class="spacer"></div>
                    
					<?php if ($nameExists): ?>
					<div class="warning-message">
						<p>Sorry, that username is already in use.</p>
					</div>
					<div class="spacer"></div>
					<?php elseif ($registerError): ?>
					<div class="warning-message">
						<p><?= $registerError ?></p>
					</div>
					<div class="spacer"></div>
                    <?php endif; ?>
                    
					<div class="button-set">
						<button type="submit">Register</button>
                    </div>
                    
				</form>
			</section>
		</article>
	</main>
	<?php ui('footer'); ?>
</body>
</html>
