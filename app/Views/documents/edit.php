<h2>Editar Documento: <?= htmlspecialchars($document->DOC_CODIGO) ?></h2>

<form action="/documentos/editar/<?= $document->DOC_ID ?>" method="POST">
    <div class="form-group">
        <label for="DOC_NOMBRE">Nombre del Documento</label>
        <input type="text" name="DOC_NOMBRE" id="DOC_NOMBRE" required maxlength="255" value="<?= htmlspecialchars($document->DOC_NOMBRE) ?>">
    </div>

    <div class="form-group">
        <label for="DOC_ID_TIPO">Tipo de Documento</label>
        <select name="DOC_ID_TIPO" id="DOC_ID_TIPO" required>
            <?php foreach ($types as $type): ?>
                <option value="<?= $type->TIP_ID ?>" <?= $document->DOC_ID_TIPO == $type->TIP_ID ? 'selected' : '' ?>>
                    <?= $type->TIP_NOMBRE ?> (<?= $type->TIP_PREFIJO ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="DOC_ID_PROCESO">Proceso</label>
        <select name="DOC_ID_PROCESO" id="DOC_ID_PROCESO" required>
            <?php foreach ($processes as $process): ?>
                <option value="<?= $process->PRO_ID ?>" <?= $document->DOC_ID_PROCESO == $process->PRO_ID ? 'selected' : '' ?>>
                    <?= $process->PRO_NOMBRE ?> (<?= $process->PRO_PREFIJO ?>)
                </option>
            <?php endforeach; ?>
        </select>
    </div>

    <div class="form-group">
        <label for="DOC_CONTENIDO">Contenido</label>
        <textarea name="DOC_CONTENIDO" id="DOC_CONTENIDO" required><?= htmlspecialchars($document->DOC_CONTENIDO) ?></textarea>
    </div>

    <div style="margin-top: 2rem;">
        <button type="submit" class="btn btn-success">Actualizar Documento</button>
        <a href="/documentos" class="btn btn-primary" style="background-color: #7f8c8d;">Cancelar</a>
    </div>
</form>
