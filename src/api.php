<?php
require_once __DIR__ . '/models/Todo.php';
require_once __DIR__ . '/models/User.php';

// Set JSON header
header('Content-Type: application/json');

// Parse the endpoint from the URL
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$path = trim($path, '/');

// Remove 'src/' if present
if (strpos($path, 'src/') === 0) {
    $path = substr($path, 4);
}

// Route API endpoints
switch ($path) {
    case 'api/todos':
        $mysqli = new mysqli("db", "user", "userpass", "myapp");
        $todoModel = new Todo($mysqli);

        $user_id = isset($_GET['user_id']) ? (int)$_GET['user_id'] : null;
        if ($user_id) {
            $todos = $todoModel->allByUser($user_id);
        } else {
            $todos = $todoModel->all();
        }
        echo json_encode($todos);
        break;

    // Add more API endpoints here

    default:
        http_response_code(404);
        echo json_encode(['error' => 'Not found']);
        break;
}