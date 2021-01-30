<?php
require $_SERVER['DOCUMENT_ROOT'] . '/App.php';
require 'page.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ui('meta', ['title' => $title]); ?>
	<link rel="stylesheet" href="/css/auth.css">
	<script defer src="/js/form-field-validity.js"></script>
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
				<form method="POST" class="login-form" onsubmit="this.querySelectorAll('[type=submit]').forEach(el => el.disabled = true)">
                    
					<label>Choose a Username
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
                    
					<label>Choose a Strong Password
						<input 
						type="password" 
						name="password" 
						value="<?= safe($password) ?>" 
						required
						class="<?= $passwordClass ?>"
						>
                    </label>
                    <div class="spacer"></div>
                    
					<label>Choose a Security Question
						<textarea 
						name="security_question" 
						rows="3" 
						maxlength="<?= $securityQuestionMaxlength ?>" 
						required
						class="<?= $securityQuestionClass ?>"
						><?= safe($securityQuestion) ?></textarea>
					</label>
                    <div class="spacer"></div>
                    
					<label>Security Question Answer
						<input 
						type="text" 
						name="security_answer" 
						value="<?= safe($securityAnswer) ?>" 
						required
						autocomplete="off"
						class="<?= $securityAnswerClass ?>"
						>
					</label>
                    <div class="spacer"></div>
                    
					<?php if ($registerError): ?>
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
