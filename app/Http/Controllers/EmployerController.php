<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;
use App\Models\Application;
use Illuminate\Support\Facades\DB;

class EmployerController extends EmployerBaseController
{
    public function dashboard()
    {
        $employer = $this->getEmployer();
        if (!$employer) {
        abort(403, 'Employer not found or not logged in');
    }

        // JOB COUNT
        $jobs = JobPosting::where(
            'employer_id',
            $employer->employer_id
        )->count();

        // JOB IDS
        $jobIds = JobPosting::where(
            'employer_id',
            $employer->employer_id
        )->pluck('job_id');

        // TOTAL APPLICATIONS
        $applications = Application::whereIn(
            'job_id',
            $jobIds
        )->count();

        // STATUS COUNT
        $pending = Application::whereIn('job_id', $jobIds)
            ->where('status', 0)
            ->count();

        $approved = Application::whereIn('job_id', $jobIds)
            ->where('status', 1)
            ->count();

        $rejected = Application::whereIn('job_id', $jobIds)
            ->where('status', 2)
            ->count();

        // CHART
        $monthlyApplications = Application::select(
                DB::raw('MONTH(applied_date) as month'),
                DB::raw('COUNT(*) as total')
            )
            ->whereIn('job_id', $jobIds)
            ->groupBy(DB::raw('MONTH(applied_date)'))
            ->orderBy('month')
            ->get();

        // DATA CHART
        $chartData = array_fill(1, 12, 0);

        foreach ($monthlyApplications as $item) {
            $chartData[$item->month] = $item->total;
        }

        return view('employer.dashboard', [

            'jobs' => $jobs,

            'applications' => $applications,

            'pending' => $pending,

            'approved' => $approved,

            'rejected' => $rejected,

            'chartData' => array_values($chartData)
        ]);
    }
}