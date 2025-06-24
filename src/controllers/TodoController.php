<?php

require_once __DIR__ . '/../models/Todo.php';

class TodoController
{
    private $todo;

    public function __construct($mysqli)
    {
        $this->todo = new Todo($mysqli);
    }

    public function index()
    {
        $todos = $this->todo->all();
        require __DIR__ . '/../views/todos/index.php';
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

    // You can add more methods for updateStatus and delete if needed
}