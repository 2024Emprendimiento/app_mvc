<?php
require_once __DIR__ . '/../models/User.php';

class AuthController {
    public function showLogin()
    {
        include __DIR__ . '/../views/auth/login.php';
    }

    public function login()
    {
        session_start();
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
        $error = '';

        if(!$email || !$password) {
            $error = 'Email y contraseña son requeridos.';
            include __DIR__ . '/../views/auth/login.php';
            return;
        }
        $userModel = new User();
        $user = $userModel->findByEmail($email);
       

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            header("Location: index.php?controller=user&action=index");
        } else {
            $error = 'Credenciales incorrectas';
            include __DIR__ . '/../views/auth/login.php';
        }
    }
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=auth&action=showLogin");
    }
}