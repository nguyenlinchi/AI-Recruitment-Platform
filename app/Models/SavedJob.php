<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SavedJob extends Model
{
    protected $table = 'saved_jobs';

    public $timestamps = false;

    protected $fillable = [
        'candidate_id',
        'job_id'
    ];

    // =========================
    // RELATION JOB
    // =========================
    public function job()
    {
        return $this->belongsTo(
            JobPosting::class,
            'job_id',
            'job_id'
        );
    }
}