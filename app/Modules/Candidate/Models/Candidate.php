<?php

namespace App\Modules\Candidate\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Candidate extends Model
{
    protected $table = 'candidates';

    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'resume_url',
    ];
}
