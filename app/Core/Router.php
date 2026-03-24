<?php

namespace App\Core;

/**
 * Clase Router
 * Maneja el enrutamiento de la aplicación y el despacho a controladores.
 */
class Router
{
    /** @var array Rutas registradas */
    private $routes = [];

    /**
     * Registra una ruta GET.
     * 
     * @param string $path Ruta URL.
     * @param array $callback [Clase::class, 'metodo']
     */
    public function get(string $path, array $callback)
    {
        $this->routes['GET'][$path] = $callback;
    }

    /**
     * Registra una ruta POST.
     * 
     * @param string $path Ruta URL.
     * @param array $callback [Clase::class, 'metodo']
     */
    public function post(string $path, array $callback)
    {
        $this->routes['POST'][$path] = $callback;
    }

    /**
     * Resuelve la ruta actual y ejecuta el controlador correspondiente.
     * 
     * @return void
     */
    public function dispatch()
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        
        // Ajustar URI para subdirectorios (como /prueba_tecnica/)
        $scriptPath = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
        $basePath = rtrim($scriptPath, '/public'); // Quitamos /public del path
        
        if ($basePath !== '' && $basePath !== '/') {
            $uri = substr($uri, strlen($basePath));
        }

        $uri = empty($uri) ? '/' : $uri;
        if ($uri !== '/' && substr($uri, -1) === '/') {
            $uri = rtrim($uri, '/');
        }
        
        // Manejo básico de rutas dinámicas {id}
        foreach ($this->routes[$method] as $path => $callback) {
            // Reemplaza {id} por una expresión regular que capture números
            $regex = preg_replace('/\{[a-zA-Z]+\}/', '([0-9]+)', $path);
            $regex = str_replace('/', '\/', $regex);
            
            if (preg_match('/^' . $regex . '$/', $uri, $matches)) {
                array_shift($matches); // Quita el match completo
                [$controllerClass, $methodName] = $callback;
                
                $controller = new $controllerClass();
                call_user_func_array([$controller, $methodName], $matches);
                return;
            }
        }

        // Si no encuentra la ruta, muestra 404
        http_response_code(404);
        echo "404 Not Found";
    }
}
