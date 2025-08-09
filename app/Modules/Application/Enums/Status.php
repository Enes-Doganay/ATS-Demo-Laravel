<?php

namespace App\Modules\Application\Enums;

enum Status: string
{
    case APPLIED = 'applied';
    case REJECTED = 'rejected';
    case SHORTLISTED = 'shortlisted';
}