<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class JobPosting extends Model
{
    protected $table = 'job_postings';
    protected $primaryKey = 'job_id';
    public $timestamps = false;

     protected $fillable = [
        'employer_id',
        'job_title',
        'category_id',
        'job_type_id',
        'salary_id',
        'level_id',
        'location_id',
        'workplace',
        'quantity',
        'gender',
        'job_description',
        'candidate_requirements',
        'benefits',
        'deadline',
        'posted_date',
        'status'
    ];

    public function employer()
    {
        return $this->belongsTo(Employer::class, 'employer_id');
    }

    public function jobType()
    {
        return $this->belongsTo(JobType::class, 'job_type_id');
    }

    public function salary()
    {
        return $this->belongsTo(Salary::class, 'salary_id');
    }

    public function location()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
    public function savedBy()
    {
        return $this->hasMany(
            SavedJob::class,
            'job_id',
            'job_id'
        );
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
     public function applications()
    {
        return $this->hasMany(Application::class, 'job_id');
    }
}