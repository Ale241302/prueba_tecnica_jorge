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
     * Establece un mensaje flash (disponible solo para la siguiente carga).
     * 
     * @param string $key Clave del mensaje.
     * @param mixed $value Valor a guardar.
     */
    public static function flash(string $key, $value)
    {
        self::start();
        $_SESSION['_flash'][$key] = $value;
    }

    /**
     * Obtiene y elimina un mensaje flash.
     * 
     * @param string $key Clave del mensaje.
     * @return mixed|null
     */
    public static function getFlash(string $key)
    {
        self::start();
        $value = $_SESSION['_flash'][$key] ?? null;
        unset($_SESSION['_flash'][$key]);
        return $value;
    }

    /**
     * Verifica si existe un mensaje flash.
     * 
     * @param string $key Clave del mensaje.
     * @return bool
     */
    public static function hasFlash(string $key): bool
    {
        self::start();
        return isset($_SESSION['_flash'][$key]);
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
