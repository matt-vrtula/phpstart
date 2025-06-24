<?php
// Database connection
$retries = 5;
while ($retries > 0) {
    $mysqli = @new mysqli("db", "user", "userpass", "myapp");
    if ($mysqli->connect_errno) {
        $retries--;
        sleep(3);
    } else {
        break;
    }
}
if ($mysqli->connect_errno) {
    die("Failed to connect to MySQL: " . $mysqli->connect_error);
}

// Controller
require_once __DIR__ . '/controllers/TodoController.php';
$controller = new TodoController($mysqli);

// Routing
$action = $_GET['action'] ?? 'index';
switch ($action) {
    case 'create':
        $controller->create();
        break;
    default:
        $controller->index();
        break;
}