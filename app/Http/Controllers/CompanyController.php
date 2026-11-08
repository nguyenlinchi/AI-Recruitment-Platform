<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employer;
use App\Models\JobPosting;
use App\Models\Location;
use App\Models\Level;


class CompanyController extends Controller
{
     public function show(Request $request, $id)
    {
        $company = Employer::withCount('jobs')
            ->findOrFail($id);

        $query = JobPosting::with([
                'jobType',
                'salary',
                'location',
                'level'
            ])
            ->where('employer_id', $id)
            ->where('status', 1)
            ->limit(10);

        if ($request->filled('keyword')) {
            $query->where('job_title', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        $jobs = $query->orderBy('job_id', 'desc')->paginate(6);

        $jobs->appends($request->all());

        $locations = Location::all();

        return view('candidate/company', compact('company', 'jobs', 'locations'));
    }
}