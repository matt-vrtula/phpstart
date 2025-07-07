<?php 
    // require_once __DIR__ . '/../controllers/AuthController.php'; 
    require_once __DIR__ . '/../helpers/helpers.php'; // Adjust the path as needed
    // $authController = new AuthController($mysqli);
    // $loggedIn = $authController->isLoggedIn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $title ?? 'My App'; ?></title>
    <link rel="stylesheet" href="/styles.css?v=<?php echo filemtime($_SERVER['DOCUMENT_ROOT'] . '/styles.css'); ?>">
</head>
<body>
    <div class="container">
        <?php if (isLoggedIn()): ?>
        <nav class="sidebar">
            <ul>
                <li><a href="/todos">Todos</a></li>
                <li><a href="/users">Users</a></li>
                <?php if (isLoggedIn()): ?>
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