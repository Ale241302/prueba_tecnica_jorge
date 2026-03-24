<?php

namespace App\Core;

use Illuminate\Database\Eloquent\Model as EloquentModel;

/**
 * Clase Model
 * Clase base para todos los modelos del sistema, extiende de Eloquent Model.
 */
abstract class Model extends EloquentModel
{
    // Desactivamos los timestamps si no se definen en las tablas
    public $timestamps = false;
}
