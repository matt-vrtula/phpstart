<h1>Register</h1>
<form method="post" action="/register">
    <input type="text" name="name" required placeholder="Name">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit">Register</button>
</form>

<p>
    Already have an account?
    <a href="/login">Login here</a>
</p>

<?php if (!empty($error)): ?>
    <div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>