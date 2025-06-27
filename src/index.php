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
require_once __DIR__ . '/controllers/UserController.php';

// Get the path from the URL
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($path, '/');
$action = $_GET['action'] ?? '';
$method = $_SERVER['REQUEST_METHOD'];

// Remove any base directory if your app is not in the web root
// For example, if your app is in /src, use:
if (strpos($path, 'src/') === 0) {
    $path = substr($path, 4);
}

$todoController = new TodoController($mysqli);
$userController = new UserController($mysqli);

switch ($path) {
    case '':
    case 'todos':
        if($method === 'POST' && $action === 'createTodo') {
            $todoController->create();
        } elseif ($method === 'POST' && $action === 'updateStatus') {
            $todoController->updateStatus();
        } elseif ($method === 'POST' && $action === 'deleteTodo') {
            $todoController->delete();
        } else {
            $todoController->index();
        }
        break;
    case 'users':
        // $userController->index();
        if($method === 'POST' && $action === 'createUser') {
            $userController->create();
        } elseif ($method === 'POST' && $action === 'deleteUser') {
            $userController->delete();
        } else {
            $userController->index();
        }
        break;
    default:
        if (strpos($path, 'api/') === 0) {
            // Do nothing, let api.php handle it
            exit;
        }
        header("Location: /todos");
        exit;
}