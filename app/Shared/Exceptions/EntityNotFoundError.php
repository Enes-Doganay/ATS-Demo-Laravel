<?php

namespace App\Shared\Exceptions;

use Exception;

class EntityNotFoundError extends Exception
{
    public function __construct(string $entityName, $identifier = null)
    {
        $message = $identifier 
            ? "{$entityName} with identifier {$identifier} not found." 
            : "{$entityName} not found.";

        parent::__construct($message, 404);
    }
}