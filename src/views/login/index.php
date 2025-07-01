<form method="post" action="/login">
    <input type="email" name="email" required placeholder="Email">
    <input type="password" name="password" required placeholder="Password">
    <button type="submit">Login</button>
</form>

<p>
    Not registered?
    <a href="/register">Create an account</a>
</p>

<?php if (!empty($error)): ?>
    <div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>