<?php

namespace App\Models;

use App\Core\Model;

/**
 * Clase Document
 * Representa la tabla DOC_DOCUMENTO.
 */
class Document extends Model
{
    /** @var string Nombre de la tabla */
    protected $table = 'DOC_DOCUMENTO';

    /** @var string Clave primaria */
    protected $primaryKey = 'DOC_ID';

    /** @var array Campos que se pueden asignar masivamente */
    protected $fillable = [
        'DOC_NOMBRE',
        'DOC_CODIGO',
        'DOC_CONTENIDO',
        'DOC_ID_TIPO',
        'DOC_ID_PROCESO'
    ];

    /**
     * Relación con el tipo de documento.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function type()
    {
        return $this->belongsTo(DocumentType::class, 'DOC_ID_TIPO', 'TIP_ID');
    }

    /**
     * Relación con el proceso.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function process()
    {
        return $this->belongsTo(Process::class, 'DOC_ID_PROCESO', 'PRO_ID');
    }
}
