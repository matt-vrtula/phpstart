<?php
class AuthController
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function login()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            $stmt = $this->mysqli->prepare("SELECT id, password_hash, name FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->bind_result($id, $hash, $name);

            if ($stmt->fetch() && password_verify($password, $hash)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['user_name'] = $name;
                header('Location: /todos');
                exit;
            } else {
                $error = "Invalid email or password.";
            }
        }
        $title = 'Login';
        $view = __DIR__ . '/../views/login/index.php';
        require __DIR__ . '/../views/layout.php';
    }

    public function register()
    {
        $error = '';
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            // Check if email already exists
            $stmt = $this->mysqli->prepare("SELECT id FROM users WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $stmt->store_result();
            if ($stmt->num_rows > 0) {
                $error = "Email already registered.";
            } else {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $this->mysqli->prepare("INSERT INTO users (name, email, password_hash) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $name, $email, $hash);
                if ($stmt->execute()) {
                    header('Location: /login');
                    exit;
                } else {
                    $error = "Registration failed.";
                }
            }
        }
        $title = 'Register';
        $view = __DIR__ . '/../views/register/index.php';
        require __DIR__ . '/../views/layout.php';
    }
    
    public function logout()
    {
        session_destroy();
        header('Location: /login');
        exit;
    }
}