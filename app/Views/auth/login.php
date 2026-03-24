<form action="<?= BASE_URL ?>/login" method="POST" style="max-width: 400px; margin: 0 auto; padding: 1rem;">
    <h2 style="text-align: center; margin-bottom: 2rem;"><i class="fas fa-lock"></i> Iniciar Sesión</h2>

    <?php if (isset($error)): ?>
        <div class="alert alert-error" style="margin-bottom: 1.5rem;"><i class="fas fa-exclamation-circle"></i> <?= $error ?></div>
    <?php endif; ?>

    <div class="form-group">
        <label for="username">Usuario</label>
        <div style="position: relative;">
            <i class="fas fa-user" style="position: absolute; left: 12px; top: 12px; color: #a0aec0;"></i>
            <input type="text" name="username" id="username" required style="padding-left: 35px;" placeholder="Ingresa tu usuario">
        </div>
    </div>
    <div class="form-group">
        <label for="password">Contraseña</label>
        <div style="position: relative;">
            <i class="fas fa-key" style="position: absolute; left: 12px; top: 12px; color: #a0aec0;"></i>
            <input type="password" name="password" id="password" required style="padding-left: 35px; padding-right: 40px;" placeholder="Ingresa tu contraseña">
            <i class="fas fa-eye" id="togglePassword" style="position: absolute; right: 12px; top: 12px; color: #a0aec0; cursor: pointer;"></i>
        </div>
    </div>
    <button type="submit" class="btn btn-primary" style="width: 100%; margin-top: 1rem;">
        <i class="fas fa-sign-in-alt"></i> Entrar
    </button>
</form>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function (e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye / eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
</script>
