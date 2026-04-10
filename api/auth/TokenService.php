<?php
require __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . "/../config/Database.php";

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class TokenService {
    private const ALGO = "HS256";
    private const ACCESS_TTL  = 600;    // 10 min
    private const REFRESH_TTL = 604800; // 7 giorni
    private const ISSUER = "https://localhost";
    private const AUDIENCE = "https://localhost";

    // TOKEN GENERATION //

    public function generateRefreshToken($username, $id) {
        $encoded = $this->encode($username, $id, self::REFRESH_TTL, REFRESH_TOKEN_KEY);
        return $encoded;      
    }
    public function generateAccessToken($username, $id) {
        $encoded = $this->encode($username, $id, self::ACCESS_TTL, ACCESS_TOKEN_KEY);
        return $encoded;
    }
    private function encode($username, $id, $ttl, $key) {
        $payload = $this->payload($username, $id, $ttl);
        $jwt = JWT::encode($payload, $key, self::ALGO);
        return $jwt;
    }

    private function payload(string $username, int $id, int $ttl) {
        $now = time();
        return [
            "iss" => self::ISSUER,
            "aud" => self::AUDIENCE,
            "iat" => $now,
            "nbf" => $now,
            "exp" => $now + $ttl,
            "userdata" => compact("id", "username"),
        ];
    }

    // TOKEN VALIDATION //

    public function validateRefreshToken($token) {
        $decoded = $this->decode($token, REFRESH_TOKEN_KEY);
        return $decoded->userdata;
    }
    public function validateAccessToken($token) {
        $decoded = $this->decode($token, ACCESS_TOKEN_KEY);
        return $decoded->userdata;
    }

    private function decode(string $token, string $key) {
        try {
            $decodedJwt = JWT::decode($token, new Key($key, self::ALGO));
            return $decodedJwt;
        } catch (LogicException $e) {
            throw new Exception("Token decoding error: " . $e->getMessage());
        } catch (UnexpectedValueException $e) {
            throw new Exception("Invalid token: " . $e->getMessage());
        }
    }
}
?>