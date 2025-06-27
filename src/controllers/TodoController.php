<?php

require_once __DIR__ . '/../models/Todo.php';
require_once __DIR__ . '/../models/User.php';

class TodoController
{
    private $todo;
    private $user;

    public function __construct($mysqli)
    {
        $this->todo = new Todo($mysqli);
        $this->user = new User($mysqli);
    }

    public function index() {
        $users = $this->user->all();
        $todos = $this->todo->all();
        $title = 'Todo List';
        $view = __DIR__ . '/../views/todos/index.php';
        require __DIR__ . '/../views/layout.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['title']) && !empty($_POST['user_id'])) {
            $title = trim($_POST['title']);
            $user_id = (int)$_POST['user_id'];
            $this->todo->create($title, $user_id);
        }
        header('Location: /todos');
        exit;
    }

    public function updateStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['status'])) {
            $id = (int)$_POST['id'];
            $status = (int)$_POST['status'];
            $this->todo->updateStatus($id, $status);
        }
        header('Location: index.php');
        exit;
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            $this->todo->delete($id);
        }
        header('Location: /todos');
        exit;
    }

    // You can add more methods for updateStatus and delete if needed
}