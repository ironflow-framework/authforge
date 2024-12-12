<?php

namespace AuthForge\Security;

use Symfony\Component\PasswordHasher\Hasher\PasswordHasherFactory;
use Symfony\Component\PasswordHasher\PasswordHasherInterface;

class PasswordHasher
{
    private PasswordHasherInterface $passwordHasher;

    public function __construct()
    {
        $factory = new PasswordHasherFactory([
            'default' => ['algorithm' => 'bcrypt']
        ]);

        $this->passwordHasher = $factory->getPasswordHasher('default');
    }

    /**
     * Hash a plain text password.
     *
     * @param string $plainPassword
     * @return string
     */
    public function hashPassword(string $plainPassword): string
    {
        return $this->passwordHasher->hash($plainPassword);
    }

    /**
     * Verify a plain password against a hashed password.
     *
     * @param string $hashedPassword
     * @param string $plainPassword
     * @return bool
     */
    public function verifyPassword(string $hashedPassword, string $plainPassword): bool
    {
        return $this->passwordHasher->verify($hashedPassword, $plainPassword);
    }
}
