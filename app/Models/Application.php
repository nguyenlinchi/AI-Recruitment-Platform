<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    
    protected $table = 'applications';

    protected $primaryKey = 'application_id';
    public $timestamps = false;

    protected $fillable = [

        'job_id',
        'candidate_id',
        'resume_id',
        'resume_link',
        'applied_date',
        'status'

    ];


    public function resume()
    {
        return $this->belongsTo(
            Resume::class,
            'resume_id',
            'resume_id'
        );
    }


    public function candidate()
    {
        return $this->belongsTo(
            Candidate::class,
            'candidate_id',
            'candidate_id'
        );
    }


    public function job()
    {
        return $this->belongsTo(
            JobPosting::class,
            'job_id',
            'job_id'
        );
    }
}