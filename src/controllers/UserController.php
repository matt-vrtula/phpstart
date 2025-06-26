<?php
require_once __DIR__ . '/../models/User.php';

class UserController
{
    private $user;

    public function __construct($mysqli)
    {
        $this->user = new User($mysqli);
    }

public function index() {
    $users = $this->user->all();
    $title = 'User Management';
    $view = __DIR__ . '/../views/users/index.php';
    require __DIR__ . '/../views/layout.php';
}

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['name'])) {
            $this->user->create(trim($_POST['name']));
        }
        header('Location: /users');
        exit;
    }

    public function delete()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $this->user->delete((int)$_POST['id']);
        }
        header('Location: /users');
        exit;
    }
}