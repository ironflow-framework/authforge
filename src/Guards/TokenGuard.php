<?php

namespace AuthForge\Guards;

use AuthForge\Utils\JwtHelper;
use AuthForge\Providers\UserProvider;

class TokenGuard
{
    private $user;

    public function authenticate(array $credentials): string
    {
        $user = UserProvider::getByEmail($credentials['email']);
        if ($user && password_verify($credentials['password'], $user->getPassword())) {
            $token = JwtHelper::generateToken(['email' => $user->getUserIdentifier()]);
            return $token;
        }
        return '';
    }

    public function getUser(string $token)
    {
        $data = JwtHelper::validateToken($token);
        if ($data) {
            $this->user = UserProvider::getByEmail($data['email']);
        }
        return $this->user;
    }

    public function logout(): void
    {
        $this->user = null; // Les JWT n'ont pas de gestion de session serveur.
    }
}
