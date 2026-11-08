<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'resumes';

    protected $primaryKey = 'resume_id';
    public $timestamps = false;

    protected $fillable = [

        'resume_title',
        'candidate_id',
        'category_id',
        'job_type_id',
        'level_id',
        'career_objective',
        'experience',
        'education',
        'soft_skills',
        'awards'

    ];


    public function candidate()
    {
        return $this->belongsTo(
            Candidate::class,
            'candidate_id',
            'candidate_id'
        );
    }
}