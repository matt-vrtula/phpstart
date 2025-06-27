<h1>Todo List</h1>

<!-- <form method="post" action="?action=createTodo">
    <input type="text" name="title" placeholder="New todo..." required>
    <button type="submit">Add</button>
</form> -->
<form method="post" action="?action=createTodo">
    <input type="text" name="title" placeholder="New todo..." required>
    <select name="user_id" required>
        <option value="">Assign user</option>
        <?php foreach ($users as $user): ?>
            <option value="<?php echo $user['id']; ?>"><?php echo htmlspecialchars($user['name']); ?></option>
        <?php endforeach; ?>
    </select>
    <button type="submit">Add</button>
</form>

<ul>
    <?php foreach ($todos as $todo): ?>
    <li>
        <span><?php echo htmlspecialchars($todo['title']); ?></span>
        <span class="status">
            <form method="post" action="?action=updateStatus" style="display:inline;">
                <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
                <select name="status" onchange="this.form.submit()">
                    <option value="0" <?php if ($todo['status'] == 0) echo 'selected'; ?>>Todo</option>
                    <option value="1" <?php if ($todo['status'] == 1) echo 'selected'; ?>>In Progress</option>
                    <option value="2" <?php if ($todo['status'] == 2) echo 'selected'; ?>>Done</option>
                </select>
            </form>
        </span>
            <span class="assigned-user">
            <?php echo htmlspecialchars($todo['user_name'] ?? 'Unassigned'); ?>
        </span>
        <form method="post" action="/todos?action=deleteTodo" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo $todo['id']; ?>">
            <button type="submit" onclick="return confirm('Delete this todo?')">Delete</button>
        </form>
    </li>
    <?php endforeach; ?>
</ul>