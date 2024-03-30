<?php

namespace src\app\models;

use Firebase\JWT\Key;
use Firebase\JWT\JWT as FirebaseJWT;
use stdClass;

class JWT
{
    private string $secretKey;
    private string $algorithm;
    private int $expires;

    /**
     * @param string $secretKey
     * @param int $expires
     * @param string $algorithm
     */
    public function __construct(string $secretKey, int $expires = 3600, string $algorithm = 'HS256')
    {
        $this->secretKey = $secretKey;
        $this->expires = $expires;
        $this->algorithm = $algorithm;
    }

    /**
     * @param array $data
     * @return string
     */
    public function generate(array $data): string
    {
        $now = time();
        $payload = [
            'iat' => $now,
            'iss' => 'http://vktest.local:8888',
            'nbf' => $now,
            'exp' => $now + $this->expires,
            'data' => $data,
        ];

        return FirebaseJWT::encode($payload, $this->secretKey, $this->algorithm);
    }

    /**
     * @param string $token
     * @return stdClass
     */
    public function validate(string $token): stdClass
    {
        return FirebaseJWT::decode($token, new Key($this->secretKey, $this->algorithm))?->data;
    }
}
