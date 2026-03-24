<?php

namespace App\Models;

use App\Core\Model;

/**
 * Clase DocumentType
 * Representa la tabla TIP_TIPO_DOC.
 */
class DocumentType extends Model
{
    /** @var string Nombre de la tabla */
    protected $table = 'TIP_TIPO_DOC';

    /** @var string Clave primaria */
    protected $primaryKey = 'TIP_ID';

    /** @var array Campos que se pueden asignar masivamente */
    protected $fillable = ['TIP_NOMBRE', 'TIP_PREFIJO'];

    /**
     * Relación con documentos.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'DOC_ID_TIPO', 'TIP_ID');
    }
}
