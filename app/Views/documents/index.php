<div style="display: flex; justify-content: space-between; align-items: center;">
    <h2>Listado de Documentos</h2>
    <a href="<?= BASE_URL ?>/documentos/crear" class="btn btn-success">Nuevo Documento</a>
</div>

<form action="<?= BASE_URL ?>/documentos" method="GET" class="search-container">
    <input type="text" name="search" placeholder="Buscar por nombre o código..." value="<?= htmlspecialchars($search) ?>">
    <button type="submit" class="btn btn-primary">Buscar</button>
</form>

<table>
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Tipo</th>
            <th>Proceso</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($documents->isEmpty()): ?>
            <tr>
                <td colspan="5" style="text-align: center;">No se encontraron documentos.</td>
            </tr>
        <?php else: ?>
            <?php foreach ($documents as $doc): ?>
                <tr>
                    <td><strong><?= $doc->DOC_CODIGO ?></strong></td>
                    <td><?= htmlspecialchars($doc->DOC_NOMBRE) ?></td>
                    <td><?= htmlspecialchars($doc->type->TIP_NOMBRE) ?></td>
                    <td><?= htmlspecialchars($doc->process->PRO_NOMBRE) ?></td>
                    <td>
                        <a href="<?= BASE_URL ?>/documentos/editar/<?= $doc->DOC_ID ?>" class="btn btn-warning">Editar</a>
                        <form action="<?= BASE_URL ?>/documentos/eliminar/<?= $doc->DOC_ID ?>" method="POST" style="display:inline;" onsubmit="return confirm('¿Estás seguro de eliminar este documento?')">
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>
