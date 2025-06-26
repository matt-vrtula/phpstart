<?php

require_once __DIR__ . '/../models/Todo.php';

class TodoController
{
    private $todo;

    public function __construct($mysqli)
    {
        $this->todo = new Todo($mysqli);
    }

    public function index() {
        $todos = $this->todo->all();
        $title = 'Todo List';
        $view = __DIR__ . '/../views/todos/index.php';
        require __DIR__ . '/../views/layout.php';
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['title'])) {
            $title = trim($_POST['title']);
            $this->todo->create($title);
        }
        header('Location: index.php');
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

    // You can add more methods for updateStatus and delete if needed
}