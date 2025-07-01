<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?? 'My App'; ?></title>
    <link rel="stylesheet" href="/styles.css?v=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . '/styles.css'); ?>">
</head>
<body>
    <div class="container">
        <?php if (isset($_SESSION['user_id'])): ?>
        <nav class="sidebar">
            <ul>
                <li><a href="/todos">Todos</a></li>
                <li><a href="/users">Users</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="/logout">Logout</a></li>
                <?php endif; ?>
            </ul>
        </nav>
        <?php endif; ?>
        <main class="content">
            <?php
            if (isset($view)) {
                include $view;
            }
            ?>
        </main>
    </div>
</body>
</html>