<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;
use App\Models\Document;
use App\Models\DocumentType;
use App\Models\Process;
use App\Helpers\CodeGenerator;

/**
 * Clase DocumentController
 * Gestiona el CRUD completo de los registros de documentos.
 */
class DocumentController extends Controller
{
    /**
     * Verifica que el usuario esté autenticado antes de cada acción.
     */
    public function __construct()
    {
        if (!Session::isLoggedIn()) {
            $this->redirect('/login');
        }
    }

    /**
     * Muestra el listado de documentos con buscador.
     * 
     * @return void
     */
    public function index()
    {
        $search = $_GET['search'] ?? '';
        
        $query = Document::with(['type', 'process']);

        if (!empty($search)) {
            $query->where('DOC_NOMBRE', 'LIKE', "%{$search}%")
                  ->orWhere('DOC_CODIGO', 'LIKE', "%{$search}%");
        }

        $documents = $query->get();

        return $this->render('documents/index', ['documents' => $documents, 'search' => $search]);
    }

    /**
     * Muestra el formulario de creación.
     * 
     * @return void
     */
    public function create()
    {
        $types = DocumentType::all();
        $processes = Process::all();
        return $this->render('documents/create', ['types' => $types, 'processes' => $processes]);
    }

    /**
     * Procesa la creación de un nuevo documento.
     * 
     * @return void
     */
    public function store()
    {
        $type = DocumentType::find($_POST['DOC_ID_TIPO']);
        $process = Process::find($_POST['DOC_ID_PROCESO']);

        if (!$type || !$process) {
            return $this->redirect('/documentos/crear');
        }

        $code = CodeGenerator::generate($type->TIP_PREFIJO, $process->PRO_PREFIJO);

        Document::create([
            'DOC_NOMBRE'    => $_POST['DOC_NOMBRE'],
            'DOC_CODIGO'    => $code,
            'DOC_CONTENIDO' => $_POST['DOC_CONTENIDO'],
            'DOC_ID_TIPO'   => $_POST['DOC_ID_TIPO'],
            'DOC_ID_PROCESO' => $_POST['DOC_ID_PROCESO']
        ]);

        return $this->redirect('/documentos');
    }

    /**
     * Muestra el formulario de edición.
     * 
     * @param int $id ID del documento.
     * @return void
     */
    public function edit(int $id)
    {
        $document = Document::findOrFail($id);
        $types = DocumentType::all();
        $processes = Process::all();

        return $this->render('documents/edit', [
            'document'  => $document,
            'types'     => $types,
            'processes' => $processes
        ]);
    }

    /**
     * Actualiza un documento existente.
     * 
     * @param int $id ID del documento.
     * @return void
     */
    public function update(int $id)
    {
        $document = Document::findOrFail($id);
        $oldType = $document->DOC_ID_TIPO;
        $oldProcess = $document->DOC_ID_PROCESO;

        $newTypeId = (int)$_POST['DOC_ID_TIPO'];
        $newProcessId = (int)$_POST['DOC_ID_PROCESO'];

        $document->DOC_NOMBRE = $_POST['DOC_NOMBRE'];
        $document->DOC_CONTENIDO = $_POST['DOC_CONTENIDO'];
        $document->DOC_ID_TIPO = $newTypeId;
        $document->DOC_ID_PROCESO = $newProcessId;

        // Si cambió el tipo o el proceso, recalculamos el código
        if ($oldType !== $newTypeId || $oldProcess !== $newProcessId) {
            $type = DocumentType::find($newTypeId);
            $process = Process::find($newProcessId);
            $document->DOC_CODIGO = CodeGenerator::generate($type->TIP_PREFIJO, $process->PRO_PREFIJO);
        }

        $document->save();

        return $this->redirect('/documentos');
    }

    /**
     * Elimina un documento.
     * 
     * @param int $id ID del documento.
     * @return void
     */
    public function destroy(int $id)
    {
        $document = Document::findOrFail($id);
        $document->delete();

        return $this->redirect('/documentos');
    }
}
