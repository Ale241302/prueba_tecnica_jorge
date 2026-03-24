<?php

namespace App\Core;

/**
 * Clase Controller
 * Clase base de la que heredan todos los controladores.
 * Proporciona funcionalidad para renderizar vistas.
 */
abstract class Controller
{
    /**
     * Renderiza una vista dentro del layout principal.
     * 
     * @param string $view Nombre de la vista (ej: 'auth/login').
     * @param array $data Datos que se pasarán a la vista.
     * @return void
     */
    protected function render(string $view, array $data = [])
    {
        // Extrae las variables del array data para que estén disponibles en la vista
        extract($data);

        // Inicia el búfer de salida para capturar el contenido de la vista
        ob_start();
        require_once __DIR__ . "/../Views/{$view}.php";
        $content = ob_get_clean();

        // Carga el layout principal inyectando el contenido de la vista
        require_once __DIR__ . "/../Views/layouts/main.php";
    }

    /**
     * Redirige a una URL específica.
     * 
     * @param string $url URL de redirección.
     * @return void
     */
    protected function redirect(string $url)
    {
        header("Location: {$url}");
        exit;
    }
}
