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

                <form method="GET" class="dashboard-filters">

                    <label>Search
                        <input type="text" name="search" value="<?= safe($searchUsername) ?>">
                    </label>

                    <label>Order By
                        <select name="order">
                            <?php foreach ($columns as $k => $v): ?>
                            <option value="<?= safe($k) ?>" <?= $userListOrder === $k ? 'selected' : '' ?>><?= safe($v) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <label>Limit
                        <select name="limit">
                            <?php foreach ($limits as $k => $v): ?>
                            <option value="<?= safe($v) ?>" <?= $userListLimit === $v ? 'selected' : '' ?>><?= safe($v) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </label>

                    <div class="dashboard-filters__buttons">
                        <button>Go</button>
                    </div>

                </form>

                <div class="dashboard-table">
                    <?php foreach ($userList as $uid => $user): ?>
                    <form method="POST" class="dashboard-table-row">

                        <input type="hidden" name="target_user" value="<?= safe($user['username']) ?>">

                        <div class="dashboard-table-row__icon">

                            <?php if ($user['is_admin'] === 1): ?>
                            <i class="fad fa-user-crown" title="Admin"></i>
                            <?php elseif ($user['is_locked'] === 1): ?>
                            <i class="fad fa-user-lock" title="Locked User"></i>
                            <?php else: ?>
                            <i class="fas fa-user" title="User"></i>
                            <?php endif; ?>
                            
                            <?php if ($user['logged_in']): ?>
                            <div class="dashboard-table-row__logged-in"></div>
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

                            <?php if ($user['is_locked'] === 1): ?>
                            <button class="plain-button dashboard-table-row__action-button" title="Unlock user" name="action" value="unlock">
                                <i class="fad fa-lock-open-alt fa-fw"></i>
                                <span>Unlock User?</span>
                            </button>
                            <?php else: ?>
                            <button class="plain-button dashboard-table-row__action-button" title="Lock user" name="action" value="lock">
                                <i class="fad fa-lock-alt fa-fw"></i>
                                <span>Lock User?</span>
                            </button>
                            <?php endif; ?>
                            
                            <button class="plain-button dashboard-table-row__action-button" title="Sign user out" name="action" value="signout">
                                <i class="fad fa-sign-out fa-fw"></i>
                                <span>Sign User Out?</span>
                            </button>

                            <?php if ($user['is_admin'] === 1): ?>
                            <button class="plain-button dashboard-table-row__action-button" title="Demote admin" name="action" value="demote">
                                <i class="fad fa-axe fa-fw"></i>
                                <span>Demote Admin?</span>
                            </button>
                            <?php else: ?>
                            <button class="plain-button dashboard-table-row__action-button" title="Promote to admin" name="action" value="promote">
                                <i class="fad fa-crown fa-fw"></i>
                                <span>Promote to Admin?</span>
                            </button>
                            <?php endif; ?>

                            <button class="plain-button dashboard-table-row__action-button" title="Delete user" name="action" value="delete">
                                <i class="fad fa-trash fa-fw"></i>
                                <span>Delete User?</span>
                            </button>

                            <button class="plain-button dashboard-table-row__cancel-button" title="Cancel">
                                <i class="fad fa-times-circle fa-fw"></i>
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
