<?php

namespace AuthForge\Providers;

use AuthForge\Models\User;

class UserProvider
{
    public static function getByEmail(string $email): ?User
    {
        // Implémente la logique pour récupérer l'utilisateur depuis ta base de données.
        // Exemple :
        $data = Database::query('SELECT * FROM users WHERE email = ?', [$email]);
        if ($data) {
            $user = new User();
            $user->id = $data['id'];
            $user->name = $data['name'];
            $user->email = $data['email'];
            $user->setPassword($data['password']);
            $user->roles = explode(',', $data['roles']);
            return $user;
        }
        return null;
    }
}
