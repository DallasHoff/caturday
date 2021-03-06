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
						<h2>Forgot Your Password?</h2>
						<p>Answer your security question to reset your password and regain access to your account.</p>
						
						<?php if ($action === 'get_question' && !empty($securityQuestion)): ?>
						<div class="spacer"></div>
						<h3>Security Question</h3>
						<p><?= safe($securityQuestion) ?></p>
						<?php endif; ?>
					</div>
					<form method="POST" class="login-form">

						<?php if ($action === 'initial'): ?>
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
						<?php else: ?>
							<input 
							type="hidden" 
							name="username" 
							value="<?= safe($username) ?>" 
							>
						<?php endif; ?>
						
						<?php if ($action === 'get_question'): ?>
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
						<label>New Password
							<input 
							type="password" 
							name="new_password" 
							value="<?= safe($newPassword) ?>" 
							required 
							class="<?= $newPasswordClass ?>"
							>
						</label>
						<div class="spacer"></div>
						<?php endif; ?>
						
						<?php if ($resetError): ?>
						<div class="warning-message">
							<p><?= $resetError ?></p>
						</div>
						<div class="spacer"></div>
						<?php endif; ?>
						
						<?php if ($action === 'initial'): ?>
						<div class="button-set">
							<button name="action" value="get_question">Get Question</button>
						</div>
						<?php elseif ($action === 'get_question'): ?>
						<div class="button-set">
							<button name="action" value="reset_password">Reset Password</button>
						</div>
						<?php endif; ?>

						<input 
						type="hidden" 
						name="prev_action" 
						value="<?= safe($action) ?>" 
						>

					</form>
				</section>
			</article>
		</main>
		<?php ui('footer'); ?>
	</div>
</body>
</html>
