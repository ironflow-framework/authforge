<?php

namespace AuthForge\Middleware;

use AuthForge\AuthManager;

class AuthMiddleware
{
    private $auth;

    public function __construct(AuthManager $auth)
    {
        $this->auth = $auth;
    }

    public function handle(): void
    {
        if (!$this->auth->user()) {
            header('Location: /login');
            exit;
        }
    }
}
