<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use App\Models\JobPosting;
use App\Models\Employer;
use App\Models\Category;
use App\Models\CareerGuide;
use App\Models\Candidate;
use App\Models\SavedJob;
use App\Helpers\SavedJobHelper;

class HomeController extends Controller
{
    public function index(Request $request)
    {

        // DANH SÁCH VIỆC LÀM
        $query = JobPosting::with([
                'employer',
                'jobType',
                'salary',
                'location'
            ])
            ->where('status', 1);

        // Tìm theo title
        if ($request->filled('title')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'job_title',
                    'like',
                    '%' . $request->title . '%'
                )

                ->orWhereHas('jobType', function ($sub) use ($request) {

                    $sub->where(
                        'job_type_name',
                        'like',
                        '%' . $request->title . '%'
                    );

                });

            });
        }

        // Tìm theo location
        if ($request->filled('location')) {

            $query->whereHas('location', function ($q) use ($request) {

                $q->where(
                    'location_name',
                    'like',
                    '%' . $request->location . '%'
                );

            });
        }

        $jobs = $query
            ->orderBy('job_id', 'desc')
            ->paginate(8);

        $jobs->appends($request->all());



        // NHÀ TUYỂN DỤNG NỔI BẬT

        $topEmployers = Employer::withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->limit(10)
            ->get();

        $usedIds = $topEmployers->pluck('employer_id');

        $otherEmployers = Employer::withCount('jobs')
            ->whereNotIn('employer_id', $usedIds)
            ->limit(3)
            ->get();


        // DANH MỤC

        $categories = Category::withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->get();



        // BÀI VIẾT HƯỚNG NGHIỆP

        $guides = CareerGuide::with([
                'category',
                'tags'
            ])
            ->latest()
            ->limit(3)
            ->get();



        // JOB ĐÃ LƯU

        $savedJobIds = SavedJobHelper::getSavedJobIds();


        // Việc làm mới hôm nay
        $newJobsToday = JobPosting::whereDate(
            'posted_date',
            Carbon::today()
        )->count();

        // Tổng việc làm
        $totalJobs = JobPosting::where(
            'status',
            1
        )->count();

        // Tổng công ty
        $totalCompanies = Employer::count();


        $featuredCompanies = Employer::withCount([
                'jobs' => function ($query) {

                    $query->where('status', 1);

                }
            ])
            ->having('jobs_count', '>', 0)
            ->orderByDesc('jobs_count')
            ->take(3)
            ->get();



        // BIỂU ĐỒ TĂNG TRƯỞNG 7 NGÀY

        $jobGrowthLabels = [];
        $jobGrowthData = [];

        for ($i = 6; $i >= 0; $i--) {

            $date = Carbon::today()->subDays($i);

            $count = JobPosting::whereDate(
                'posted_date',
                $date
            )->count();

            $jobGrowthLabels[] = $date->format('d/m');

            $jobGrowthData[] = $count;
        }



        // BIỂU ĐỒ NGÀNH NGHỀ

        $jobsByCategory = Category::withCount('jobs')
            ->orderBy('jobs_count', 'desc')
            ->take(4)
            ->get();

        $categoryLabels = $jobsByCategory
            ->pluck('category_name');

        $categoryData = $jobsByCategory
            ->pluck('jobs_count');



        return view('candidate.home', compact(

            'jobs',
            'topEmployers',
            'otherEmployers',
            'categories',
            'guides',
            'savedJobIds',

            // dashboard
            'newJobsToday',
            'totalJobs',
            'totalCompanies',
            'featuredCompanies',

            // chart
            'jobGrowthLabels',
            'jobGrowthData',
            'categoryLabels',
            'categoryData'
        ));
    }
}