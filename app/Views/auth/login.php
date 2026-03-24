<h2>Iniciar Sesión</h2>

<?php if (isset($error)): ?>
    <div class="alert alert-error"><?= $error ?></div>
<?php endif; ?>

<form action="/login" method="POST">
    <div class="form-group">
        <label for="username">Usuario</label>
        <input type="text" name="username" id="username" required>
    </div>
    <div class="form-group">
        <label for="password">Contraseña</label>
        <input type="password" name="password" id="password" required>
    </div>
    <button type="submit" class="btn btn-primary">Entrar</button>
</form>
