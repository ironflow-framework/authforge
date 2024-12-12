<?php

namespace AuthForge\Controllers;

use AuthForge\AuthManager;

class AuthController
{
    private $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    public function login(array $credentials): void
    {
        if ($this->auth->login($credentials)) {
            echo "Login successful!";
        } else {
            echo "Invalid credentials.";
        }
    }

    public function logout(): void
    {
        $this->auth->logout();
        header('Location: /login');
    }
}
