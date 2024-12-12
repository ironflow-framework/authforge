<?php 

namespace AuthForge\Models;

use Symfony\Component\Security\Core\User\UserInterface;

class User implements UserInterface
{
    public int $id;
    public string $name;
    public string $email;
    private string $password;
    public array $roles = ['ROLE_USER'];

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $hashedPassword): void
    {
        $this->password = $hashedPassword;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }

    public function getSalt(): ?string
    {
        return null; // Non nécessaire avec bcrypt
    }

    public function getUserIdentifier(): string
    {
        return $this->email;
    }

    public function eraseCredentials(): void
    {
        // Efface toute donnée sensible temporaire
    }
}
