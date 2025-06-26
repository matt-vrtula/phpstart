<?php

class User
{
    private $mysqli;

    public function __construct($mysqli)
    {
        $this->mysqli = $mysqli;
    }

    public function all()
    {
        $result = $this->mysqli->query("SELECT * FROM users ORDER BY id DESC");
        return $result ? $result->fetch_all(MYSQLI_ASSOC) : [];
    }

    public function find($id)
    {
        $stmt = $this->mysqli->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function create($name)
    {
        $stmt = $this->mysqli->prepare("INSERT INTO users (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $stmt = $this->mysqli->prepare("DELETE FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}