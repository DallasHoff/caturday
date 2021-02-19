<?php
require $_SERVER['DOCUMENT_ROOT'] . '/App.php';
require 'page.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php ui('meta', ['title' => $title]); ?>
    <link rel="stylesheet" href="page.css">
	<script defer src="/js/local-timestamps.js"></script>
    <script defer src="page.js"></script>
</head>
<body>
	<?php ui('header', ['title' => $title]); ?>
	<main>
		<article>
			<section>
				<h2>Manage User Accounts</h2>

                <div class="dashboard-table">
                    <?php foreach ($userList as $uid => $user): ?>
                    <form method="POST" class="dashboard-table-row">

                        <input type="hidden" name="username" value="<?= safe($user['username']) ?>">

                        <div class="dashboard-table-row__icon">
                            <?php if ($user['is_admin'] === 1): ?>
                            <i class="fad fa-user-crown" title="Admin"></i>
                            <?php elseif ($user['is_blocked'] === 1): ?>
                            <i class="fad fa-user-slash" title="Blocked"></i>
                            <?php else: ?>
                            <i class="fas fa-user" title="User"></i>
                            <?php endif; ?>
                        </div>

                        <div class="dashboard-table-row__info">
                            <div>
                                <a href="/profile/?user=<?= urlencode(safe($user['username'])) ?>">
                                    <?= safe($user['username']) ?>
                                </a>
                            </div>
                            <time data-js-timestamp="<?= strtotime($user['date_joined']) * 1000 ?>">
                                <?= safe(date_format(date_create($user['date_joined']), 'd F Y h:i:s A e')) ?>
                            </time>
                        </div>

                        <div class="dashboard-table-row__actions">
                            <button class="plain-button dashboard-table-row__action-button" title="Block user" name="action" value="block">
                                <i class="fas fa-ban"></i>
                                <span>Block User?</span>
                            </button>
                            <button class="plain-button dashboard-table-row__action-button" title="Sign user out" name="action" value="signout">
                                <i class="fad fa-sign-out"></i>
                                <span>Sign User Out?</span>
                            </button>
                            <button class="plain-button dashboard-table-row__action-button" title="Promote to admin" name="action" value="promote">
                                <i class="fad fa-crown"></i>
                                <span>Promote to Admin?</span>
                            </button>
                            <button class="plain-button dashboard-table-row__action-button" title="Delete user" name="action" value="delete">
                                <i class="fad fa-trash"></i>
                                <span>Delete User?</span>
                            </button>
                            <button class="plain-button dashboard-table-row__cancel-button" title="Cancel">
                                <i class="fad fa-times-circle"></i>
                            </button>
                        </div>

                    </form>
                    <?php endforeach; ?>
                </div>
                
			</section>
		</article>
	</main>
	<?php ui('footer'); ?>
</body>
</html>
