<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
{
    protected $table = 'candidates';
    protected $primaryKey = 'candidate_id';
    public $timestamps = false;

    protected $fillable = [
        'account_id',
        'full_name',
        'phone',
        'gender',
        'date_of_birth',
        'avatar',
        'cover_image',
        'address'
    ];
    public function resumes()
    {
        return $this->hasMany(
            Resume::class,
            'candidate_id',
            'candidate_id'
        );
    }


    public function applications()
    {
        return $this->hasMany(
            Application::class,
            'candidate_id',
            'candidate_id'
        );
    }
    public function savedJobs()
    {
        return $this->hasMany(
            SavedJob::class,
            'candidate_id',
            'candidate_id'
        );
    }
     public function account()
    {
        return $this->belongsTo(Account::class, 'account_id');
    }
}