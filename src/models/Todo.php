<?php

class Todo
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function all()
    {
        $result = $this->mysqli->query("SELECT todos.*, users.name AS user_name
            FROM todos
            LEFT JOIN users ON todos.user_id = users.id
            ORDER BY todos.id DESC");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function find($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM todos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($title, $user_id) {
        $stmt = $this->mysqli->prepare("INSERT INTO todos (title, user_id) VALUES (?, ?)");
        $stmt->bind_param("si", $title, $user_id);
        return $stmt->execute();
    }

    public function updateStatus($id, $status)
    {
        $stmt = $this->mysqli->prepare("UPDATE todos SET status = ? WHERE id = ?");
        $stmt->bind_param("ii", $status, $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM todos WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}