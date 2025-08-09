<?php

namespace App\Modules\User\Enums;

enum UserRole: string {
    case ADMIN = 'admin';
    case RECRUITER = 'recruiter';
}