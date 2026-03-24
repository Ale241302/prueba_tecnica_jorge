<?php

namespace App\Models;

use App\Core\Model;

/**
 * Clase Process
 * Representa la tabla PRO_PROCESO.
 */
class Process extends Model
{
    /** @var string Nombre de la tabla */
    protected $table = 'PRO_PROCESO';

    /** @var string Clave primaria */
    protected $primaryKey = 'PRO_ID';

    /** @var array Campos que se pueden asignar masivamente */
    protected $fillable = ['PRO_NOMBRE', 'PRO_PREFIJO'];

    /**
     * Relación con documentos.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function documents()
    {
        return $this->hasMany(Document::class, 'DOC_ID_PROCESO', 'PRO_ID');
    }
}
