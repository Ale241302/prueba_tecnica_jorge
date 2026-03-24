<?php
require_once __DIR__ . '/vendor/autoload.php';
$config = [
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'prueba_tecnica_jorge',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
];
use Illuminate\Database\Capsule\Manager as Capsule;
$capsule = new Capsule;
$capsule->addConnection($config);
$capsule->setAsGlobal();

try {
    $tables = Capsule::select('SHOW TABLES');
    echo "Conexión exitosa. Tablas encontradas: " . count($tables) . "\n";
    foreach ($tables as $table) {
        print_r($table);
    }
} catch (\Exception $e) {
    echo "Error de DB: " . $e->getMessage() . "\n";
}
