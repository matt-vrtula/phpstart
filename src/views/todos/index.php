<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Todo List</title>
</head>
<body>
    <h1>Todo List</h1>

    <form method="post" action="?action=create">
        <input type="text" name="title" placeholder="New todo..." required>
        <button type="submit">Add</button>
    </form>

    <ul>
        <?php foreach ($todos as $todo): ?>
            <li>
                <?php echo htmlspecialchars($todo['title']); ?>
                (Status: 
                <?php
                    switch ($todo['status']) {
                        case 1: echo 'In Progress'; break;
                        case 2: echo 'Done'; break;
                        default: echo 'Todo';
                    }
                ?>)
                <!-- You can add edit/delete/status change links here -->
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>