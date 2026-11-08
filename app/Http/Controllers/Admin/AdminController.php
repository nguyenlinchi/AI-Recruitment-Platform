<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\JobPosting;
use App\Models\CareerGuide;
use App\Models\Skill;
use App\Models\Application;

class AdminController extends Controller
{
    public function dashboard()
    {
        // TOTAL
        $users = Account::count();
        $jobs = JobPosting::count();
        $careers = CareerGuide::count();

        // JOB STATUS
        $approvedJobs = JobPosting::where('status', 1)->count();
        $pendingJobs = JobPosting::where('status', 0)->count();
        $hiddenJobs = JobPosting::where('status', 2)->count();

        // APPLICATION STATUS
        $pendingApplications = Application::where('status', 0)->count();

        $approvedApplications = Application::where('status', 1)->count();

        $rejectedApplications = Application::where('status', 2)->count();

        // LATEST JOBS
        $latestJobs = JobPosting::with([
                'category',
                'employer',
                'location'
            ])
            ->latest('job_id')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'users',
            'jobs',
            'careers',

            // JOB STATUS
            'approvedJobs',
            'pendingJobs',
            'hiddenJobs',

            // APPLICATION STATUS
            'pendingApplications',
            'approvedApplications',
            'rejectedApplications',

            // TABLE
            'latestJobs'
        ));
    }
}