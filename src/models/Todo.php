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
        $result = $this->mysqli->query("SELECT * FROM todos ORDER BY id DESC");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function find($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM todos WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($title)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO todos (title, status) VALUES (?, 0)");
        $stmt->bind_param("s", $title);
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