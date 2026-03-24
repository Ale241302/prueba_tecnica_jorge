<?php

namespace App\Core;

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Events\Dispatcher;
use Illuminate\Container\Container;

/**
 * Clase Database
 * Se encarga de la conexión con la base de datos utilizando Eloquent ORM.
 */
class Database
{
    /**
     * Inicializa la conexión con Eloquent.
     * 
     * @param array $config Configuración de la base de datos.
     * @return void
     */
    public static function init(array $config)
    {
        $capsule = new Capsule;

        $capsule->addConnection([
            'driver'    => 'mysql',
            'host'      => $config['host'],
            'database'  => $config['database'],
            'username'  => $config['username'],
            'password'  => $config['password'],
            'charset'   => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix'    => '',
        ]);

        $capsule->setEventDispatcher(new Dispatcher(new Container));
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}
