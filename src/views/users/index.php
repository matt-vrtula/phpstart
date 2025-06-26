<h1>User Management</h1>
<form method="post" action="?action=createUser">
    <input type="text" name="name" placeholder="New user name..." required>
    <button type="submit">Add User</button>
</form>
<ul>
    <?php foreach ($users as $user): ?>
    <li>
        <?php echo htmlspecialchars($user['name']); ?>
        <form method="post" action="?action=deleteUser" style="display:inline;">
            <input type="hidden" name="id" value="<?php echo $user['id']; ?>">
            <button type="submit">Delete</button>
        </form>
    </li>
    <?php endforeach; ?>
</ul>