<?php

namespace App\Modules\JobPosting\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $table = 'job_postings';

    protected $fillable = [
        'title',
        'description',
        'location',
        'posted_by',
    ];

    public function postedByUser()
    {
        return $this->belongsTo(JobPosting::class, 'posted_by', 'id');
    }
}
