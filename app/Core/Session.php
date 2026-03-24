<?php

namespace App\Core;

/**
 * Clase Session
 * Encapsula el manejo de la sesión PHP para autenticación.
 */
class Session
{
    /**
     * Inicia la sesión si no está iniciada.
     * 
     * @return void
     */
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /**
     * Establece un valor en la sesión.
     * 
     * @param string $key Clave de la sesión.
     * @param mixed $value Valor a guardar.
     */
    public static function set(string $key, $value)
    {
        self::start();
        $_SESSION[$key] = $value;
    }

    /**
     * Obtiene un valor de la sesión.
     * 
     * @param string $key Clave de la sesión.
     * @return mixed|null
     */
    public static function get(string $key)
    {
        self::start();
        return $_SESSION[$key] ?? null;
    }

    /**
     * Verifica si el usuario está autenticado.
     * 
     * @return bool
     */
    public static function isLoggedIn(): bool
    {
        self::start();
        return isset($_SESSION['user']);
    }

    /**
     * Destruye la sesión actual.
     * 
     * @return void
     */
    public static function destroy()
    {
        self::start();
        session_unset();
        session_destroy();
    }
}
