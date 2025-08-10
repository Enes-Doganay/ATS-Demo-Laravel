<?php

namespace App\Shared\Exceptions;

use Exception;

class ForbiddenError extends Exception
{
    public function __construct(string $message = 'Forbidden')
    {
        parent::__construct($message);
    }
}