<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Session;

/**
 * Clase AuthController
 * Gestiona el inicio y cierre de sesión de los usuarios.
 */
class AuthController extends Controller
{
    /**
     * Muestra el formulario de login.
     * 
     * @return void
     */
    public function showLogin()
    {
        if (Session::isLoggedIn()) {
            return $this->redirect('/documentos');
        }
        
        $error = Session::getFlash('error');
        return $this->render('auth/login', ['error' => $error]);
    }

    /**
     * Procesa la solicitud de login.
     * 
     * @return void
     */
    public function processLogin()
    {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Credenciales hardcodeadas según requerimiento
        if ($username === 'admin' && $password === 'kawak2024') {
            Session::set('user', $username);
            return $this->redirect('/documentos');
        } else {
            Session::flash('error', 'Usuario o contraseña incorrectos');
            return $this->redirect('/login');
        }
    }

    /**
     * Cierra la sesión del usuario.
     * 
     * @return void
     */
    public function logout()
    {
        Session::destroy();
        return $this->redirect('/login');
    }
}
