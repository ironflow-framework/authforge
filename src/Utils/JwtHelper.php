<?php

namespace AuthForge\Utils;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwtHelper
{
    private const SECRET = 'your-secret-key';

    public static function generateToken(array $payload): string
    {
        return JWT::encode($payload, self::SECRET, 'HS256');
    }

    public static function validateToken(string $token): ?array
    {
        try {
            return (array) JWT::decode($token, new Key(self::SECRET, 'HS256'));
        } catch (\Exception $e) {
            return null;
        }
    }
}
