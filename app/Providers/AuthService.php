<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;

class AuthService
{
    /**
     * Valider le format du token via des règles de validation.
     *
     * @param string $token
     * @return bool
     */
    public function validate(string $token): bool
    {
        $validator = Validator::make(
            ['token' => $token],
            ['token' => 'required|string|starts_with:Bearer ']
        );

        return !$validator->fails();
    }

    /**
     * Extraire le token sans le préfixe "Bearer ".
     *
     * @param string $token
     * @return string|null
     */
    public function extractToken(string $token): ?string
    {
        if (!$this->validate($token)) {
            return null;
        }

        return str_replace('Bearer ', '', $token);
    }
}
