<?php

namespace App\Modules\Application\Models;

use App\Modules\Candidate\Models\Candidate;
use App\Modules\JobPosting\Models\JobPosting;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    protected $fillable = [
        'candidate_id',
        'job_posting_id',
        'applied_at',
        'status',
    ];

    public function candidate()
    {
        return $this->belongsTo(Candidate::class, 'candidate_id');
    }

    public function jobPosting()
    {
        return $this->belongsTo(JobPosting::class, 'job_posting_id');
    }
}