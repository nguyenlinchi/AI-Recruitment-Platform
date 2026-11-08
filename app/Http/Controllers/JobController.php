<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;
use App\Models\Category;
use App\Models\Salary;
use App\Models\Location;
use App\Helpers\SavedJobHelper;


class JobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobPosting::with([
            'employer',
            'jobType',
            'salary',
            'location'
        ])->where('status', 1);

        
        if ($request->filled('title')) {
            $query->where('job_title', 'like', '%' . $request->title . '%');
        }

       
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

       
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        
        if ($request->filled('salary')) {
            $query->whereIn('salary_id', $request->salary);
        }

        
        if ($request->filled('category')) {
            $query->whereIn('category_id', $request->category);
        }

        
        if ($request->sort == 'deadline') {
            $query->orderBy('deadline', 'asc');
        } else {
            $query->orderBy('job_id', 'desc');
        }

        $jobs = $query->paginate(9)->appends($request->all());

        $categories = Category::all();
        $salaries = Salary::all();
        $locations = Location::all(); 
        $savedJobIds = SavedJobHelper::getSavedJobIds();


        return view('candidate/jobs.index', compact('jobs', 'categories', 'salaries','locations','savedJobIds'));
    }
    public function show($id)
        {
            $job = JobPosting::with([
                'employer',
                'jobType',
                'salary',
                'location',
            ])->findOrFail($id);

            $relatedJobs = JobPosting::where('category_id', $job->category_id)
                ->where('job_id', '!=', $job->job_id)
                ->orderBy('posted_date', 'desc') 
                ->take(4)
                ->get();
            $savedJobIds = SavedJobHelper::getSavedJobIds();

            return view('candidate/jobs.show', compact('job','relatedJobs','savedJobIds'));
        }
}