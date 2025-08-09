<?php

namespace App\Modules\Candidate\Models;

use Illuminate\Database\Eloquent\Model;
use App\Modules\User\Models\User;

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

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
