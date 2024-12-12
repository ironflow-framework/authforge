<?php

namespace AuthForge\Guards;

use AuthForge\Providers\UserProvider;

class SessionGuard
{
    private $user;

    public function authenticate(array $credentials): bool
    {
        $user = UserProvider::getByEmail($credentials['email']);
        if ($user && password_verify($credentials['password'], $user->getPassword())) {
            $_SESSION['user'] = $user->getUserIdentifier();
            $this->user = $user;
            return true;
        }
        return false;
    }

    public function getUser()
    {
        if (!$this->user && isset($_SESSION['user'])) {
            $this->user = UserProvider::getByEmail($_SESSION['user']);
        }
        return $this->user;
    }

    public function logout(): void
    {
        unset($_SESSION['user']);
        $this->user = null;
    }
}
