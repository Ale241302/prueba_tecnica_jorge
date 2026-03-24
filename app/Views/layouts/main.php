<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Documentos - KAWAK</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            color: #333;
        }

        header {
            background-color: #2c3e50;
            color: white;
            padding: 1rem;
            text-align: center;
            border-bottom: 4px solid #3498db;
        }

        nav {
            background-color: #34495e;
            padding: 0.8rem;
            text-align: right;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        nav a {
            color: white;
            margin: 0 1rem;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #3498db;
        }

        .container {
            max-width: 1000px;
            margin: 2rem auto;
            background: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        }

        h1,
        h2 {
            color: #fff;
            margin-top: 0;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 1rem;
            table-layout: fixed;
        }

        th,
        td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #edf2f7;
        }

        th {
            background-color: #f8fafc;
            color: #64748b;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.025em;
        }

        /* Ellipsis for long text */
        .text-truncate {
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            display: block;
            width: 100%;
        }

        .btn {
            padding: 8px 16px;
            border-radius: 6px;
            text-decoration: none;
            cursor: pointer;
            border: none;
            font-size: 14px;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
        }

        .btn-primary {
            background-color: #3498db;
            color: white;
        }

        .btn-success {
            background-color: #2ecc71;
            color: white;
        }

        .btn-danger {
            background-color: #e74c3c;
            color: white;
        }

        .btn-warning {
            background-color: #f39c12;
            color: white;
        }

        .btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
            color: #4a5568;
        }

        input[type="text"],
        input[type="password"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #e2e8f0;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1rem;
            outline: none;
            transition: border-color 0.2s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus,
        select:focus,
        textarea:focus {
            border-color: #3498db;
        }

        .search-container {
            position: relative;
            margin-bottom: 2rem;
        }

        .search-container input {
            padding-left: 40px;
        }

        .search-container::before {
            content: "\f002";
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            position: absolute;
            left: 15px;
            top: 10px;
            color: #a0aec0;
        }

        /* Modal Styles */
        .modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 1000;
        }

        .modal {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        .modal h3 {
            margin-top: 0;
            color: #e74c3c;
        }

        .modal-buttons {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 1.5rem;
        }
    </style>
</head>

<body>

    <header>
        <h1>KAWAK - Gestión Documental</h1>
    </header>

    <?php if (\App\Core\Session::isLoggedIn()): ?>
        <nav>
            <span style="color: white; float: left; margin-top: 8px;"><i class="fas fa-user-circle"></i> Bienvenido, <strong><?= \App\Core\Session::get('user') ?></strong></span>
            <a href="<?= BASE_URL ?>/documentos"><i class="fas fa-file-alt"></i> Documentos</a>
            <a href="<?= BASE_URL ?>/logout"><i class="fas fa-sign-out-alt"></i> Salir</a>
        </nav>
    <?php endif; ?>

    <div class="container">
        <?= $content ?>
    </div>

    <!-- Modal Genérico -->
    <div id="confirmModal" class="modal-overlay">
        <div class="modal">
            <i class="fas fa-exclamation-triangle" style="font-size: 3rem; color: #e74c3c; margin-bottom: 1rem;"></i>
            <h3 id="modalTitle">¿Estás seguro?</h3>
            <p id="modalDescription">Esta acción no se puede deshacer.</p>
            <div class="modal-buttons">
                <button class="btn" onclick="closeModal()">Cancelar</button>
                <button id="modalConfirmBtn" class="btn btn-danger">Confirmar</button>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteForm = null;

        function showModal(title, description, onConfirm) {
            document.getElementById('modalTitle').innerText = title;
            document.getElementById('modalDescription').innerText = description;
            document.getElementById('modalConfirmBtn').onclick = onConfirm;
            document.getElementById('confirmModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('confirmModal').style.display = 'none';
            currentDeleteForm = null;
        }

        // Cerrar modal al clickear fuera
        window.onclick = function(event) {
            if (event.target == document.getElementById('confirmModal')) {
                closeModal();
            }
        }

        // Validación de búsqueda y Live Search
        const searchInput = document.querySelector('.search-container input');
        if (searchInput) {
            searchInput.addEventListener('input', function(e) {
                // Eliminar caracteres prohibidos: * . , + } {
                const forbidden = /[*.,+}{]/g;
                if (forbidden.test(this.value)) {
                    this.value = this.value.replace(forbidden, '');
                }

                // Live Search (Client-side translation)
                const query = this.value.toLowerCase().trim();
                const rows = document.querySelectorAll('tbody tr');

                rows.forEach(row => {
                    if (row.cells.length < 2) return; // Skip "No hay documentos" row
                    const text = row.innerText.toLowerCase();
                    row.style.display = text.includes(query) ? '' : 'none';
                });
            });
        }
    </script>

</body>

</html>