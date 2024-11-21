<?php

namespace App\Exceptions;

use Exception;

class ServiceEveningNotFoundException extends Exception
{
    /**
     * Message d'exception par défaut.
     */
    protected $message = 'Evening service data not found.';

    /**
     * Code HTTP à retourner.
     */
    protected int $statusCode = 404;

    /**
     * Récupérer le code HTTP.
     *
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}
