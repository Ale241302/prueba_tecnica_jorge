<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Documentos - KAWAK</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f4f7f6; margin: 0; color: #333; }
        header { background-color: #2c3e50; color: white; padding: 1rem; text-align: center; }
        nav { background-color: #34495e; padding: 0.5rem; text-align: right; }
        nav a { color: white; margin: 0 1rem; text-decoration: none; font-weight: bold; }
        .container { max-width: 1000px; margin: 2rem auto; background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); }
        h1, h2 { color: #2c3e50; }
        table { width: 100%; border-collapse: collapse; margin-top: 1rem; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background-color: #f2f2f2; }
        .btn { padding: 8px 16px; border-radius: 4px; text-decoration: none; cursor: pointer; border: none; font-size: 14px; }
        .btn-primary { background-color: #3498db; color: white; }
        .btn-success { background-color: #27ae60; color: white; }
        .btn-danger { background-color: #e74c3c; color: white; }
        .btn-warning { background-color: #f39c12; color: white; }
        .form-group { margin-bottom: 1rem; }
        label { display: block; margin-bottom: 0.5rem; font-weight: bold; }
        input[type="text"], input[type="password"], select, textarea { width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box; }
        textarea { height: 150px; }
        .alert { padding: 10px; margin-bottom: 1rem; border-radius: 4px; }
        .alert-error { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        .search-container { margin-bottom: 1rem; display: flex; gap: 10px; }
        .search-container input { flex-grow: 1; }
    </style>
</head>
<body>

<header>
    <h1>KAWAK - Registro de Documentos</h1>
</header>

<?php if (\App\Core\Session::isLoggedIn()): ?>
<nav>
    <span>Bienvenido, <strong><?= \App\Core\Session::get('user') ?></strong></span>
    <a href="/documentos">Documentos</a>
    <a href="/logout">Cerrar Sesión</a>
</nav>
<?php endif; ?>

<div class="container">
    <?= $content ?>
</div>

</body>
</html>
