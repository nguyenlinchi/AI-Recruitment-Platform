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

    /**
     * Tổng hợp dữ liệu hiển thị trên trang Dashboard của quản trị viên.
     * Thống kê số lượng tài khoản, tin tuyển dụng và bài viết hướng nghiệp;
     * đồng thời thống kê trạng thái tin tuyển dụng, hồ sơ ứng tuyển
     * và lấy danh sách 5 tin tuyển dụng mới nhất.
     */

    public function dashboard()
    {
        // TOTAL
        $users = Account::count();
        $jobs = JobPosting::count();
        $careers = CareerGuide::count();

        // JOB STATUS Thống kê tin tuyển dụng theo trạng thái
        $approvedJobs = JobPosting::where('status', 1)->count();
        $pendingJobs = JobPosting::where('status', 0)->count();
        $hiddenJobs = JobPosting::where('status', 2)->count();

        // APPLICATION STATUS Thống kê hồ sơ ứng tuyển theo trạng thái
        $pendingApplications = Application::where('status', 0)->count();

        $approvedApplications = Application::where('status', 1)->count();

        $rejectedApplications = Application::where('status', 2)->count();

        // LATEST JOBS
        // Lấy 5 tin tuyển dụng mới nhất, kèm thông tin danh mục, nhà tuyển dụng và địa điểm
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