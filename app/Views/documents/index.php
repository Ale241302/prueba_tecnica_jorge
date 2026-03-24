<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
    <h2><i class="fas fa-file-contract"></i> Listado de Documentos</h2>
    <a href="<?= BASE_URL ?>/documentos/crear" class="btn btn-success"><i class="fas fa-plus"></i> Nuevo Documento</a>
</div>

<div class="search-container">
    <input type="text" placeholder="Buscar por nombre o código en tiempo real..." value="<?= htmlspecialchars($search) ?>" autocomplete="off">
</div>

<table>
    <thead>
        <tr>
            <th style="width: 20%;">Código</th>
            <th style="width: 40%;">Nombre</th>
            <th style="width: 15%;">Tipo</th>
            <th style="width: 15%;">Proceso</th>
            <th style="width: 10%; text-align: center;">Acciones</th>
        </tr>
    </thead>
    <tbody>
        <?php if ($documents->isEmpty()): ?>
            <tr class="no-data">
                <td colspan="5" style="text-align: center; padding: 2rem; color: #a0aec0;">
                    <i class="fas fa-folder-open" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                    No se encontraron documentos.
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($documents as $doc): ?>
                <tr>
                    <td><strong><?= $doc->DOC_CODIGO ?></strong></td>
                    <td>
                        <span class="text-truncate" title="<?= htmlspecialchars($doc->DOC_NOMBRE) ?>">
                            <?= htmlspecialchars($doc->DOC_NOMBRE) ?>
                        </span>
                    </td>
                    <td><?= htmlspecialchars($doc->type->TIP_NOMBRE) ?></td>
                    <td><?= htmlspecialchars($doc->process->PRO_NOMBRE) ?></td>
                    <td style="text-align: center; white-space: nowrap;">
                        <a href="<?= BASE_URL ?>/documentos/editar/<?= $doc->DOC_ID ?>" class="btn btn-warning" title="Editar" style="padding: 6px 10px;">
                            <i class="fas fa-edit"></i>
                        </a>
                        <form id="delete-form-<?= $doc->DOC_ID ?>" action="<?= BASE_URL ?>/documentos/eliminar/<?= $doc->DOC_ID ?>" method="POST" style="display:inline;">
                            <button type="button" class="btn btn-danger" title="Eliminar" style="padding: 6px 10px;" 
                                    onclick="confirmDelete('<?= $doc->DOC_ID ?>', '<?= htmlspecialchars($doc->DOC_NOMBRE) ?>')">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
</table>

<script>
    function confirmDelete(id, name) {
        showModal(
            '¿Eliminar Documento?', 
            `¿Estás seguro de que deseas eliminar "${name}"? Esta acción es permanente.`,
            function() {
                document.getElementById('delete-form-' + id).submit();
            }
        );
    }
</script>
