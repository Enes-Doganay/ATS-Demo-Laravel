<?php

namespace App\Shared\Exceptions;

use Exception;

class InvalidCredentialsError extends Exception
{
    public function __construct(string $message = 'Invalid credentials')
    {
        parent::__construct($message, 401);
    }
}