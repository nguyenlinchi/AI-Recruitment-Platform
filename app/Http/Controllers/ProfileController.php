<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Candidate;
use App\Models\Resume;
use App\Models\Application;
use App\Models\JobPosting;
use App\Models\SavedJob;
use App\Models\Category;
use App\Models\JobType;
use App\Models\Level;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $candidate = Candidate::where('account_id', $user->account_id)->first();

        // Khởi tạo collection rỗng phòng trường hợp chưa có dữ liệu candidate
        $resumes = collect();
        $applications = collect();
        $savedJobs = collect();

        if ($candidate) {
            // Lấy danh sách hồ sơ nền tảng trực tuyến
            $resumes = Resume::where('candidate_id', $candidate->candidate_id)->get();

            // Lấy lịch sử ứng tuyển (Eager Loading với 'job' để tối ưu query)
            $applications = Application::where('candidate_id', $candidate->candidate_id)
                ->with('job')
                ->latest('application_id')
                ->get();

            // Danh sách công việc đã lưu hiển thị trong Modal yêu thích
            $savedJobs = SavedJob::with(['job.employer', 'job.salary'])
                ->where('candidate_id', $candidate->candidate_id)
                ->get();
        }

        $categories = Category::all();
        $jobTypes = JobType::all();
        $levels = Level::all();

        return view('candidate.profile.index', compact(
            'user', 'candidate', 'resumes', 'applications', 'savedJobs', 'categories', 'jobTypes', 'levels'
        ));
    }

    public function update(Request $request)
    {
        $request->validate([
            'full_name'     => 'required|max:100',
            'phone'         => 'nullable|max:15',
            'gender'        => 'nullable|max:10',
            'date_of_birth' => 'nullable|date',
            'address'       => 'nullable|max:255',
            'avatar'        => 'nullable|image|max:2048',
            'cover_image'   => 'nullable|image|max:3072'
        ]);

        $user = Auth::user();
        $candidate = Candidate::firstOrCreate(['account_id' => $user->account_id]);

        $candidate->full_name     = $request->full_name;
        $candidate->phone         = $request->phone;
        $candidate->gender        = $request->gender;
        $candidate->date_of_birth = $request->date_of_birth;
        $candidate->address       = $request->address;

        if ($request->hasFile('avatar')) {
            $candidate->avatar = Cloudinary::upload($request->file('avatar')->getRealPath(), ['folder' => 'avatars'])->getSecurePath();
        }

        if ($request->hasFile('cover_image')) {
            $candidate->cover_image = Cloudinary::upload($request->file('cover_image')->getRealPath(), ['folder' => 'covers'])->getSecurePath();
        }

        $candidate->save();

        return back()->with('success', 'Cập nhật thông tin cá nhân thành công!');
    }

public function storeResume(Request $request)
{
    $request->validate([
        'resume_title'     => 'required|max:255',
        'category_id'      => 'required|exists:categories,category_id', 
        'job_type_id'      => 'required|exists:job_types,job_type_id', 
        'level_id'         => 'required|exists:levels,level_id',      
        'career_objective' => 'nullable',
        'skills'           => 'nullable',
        'education'        => 'nullable',
        'experience'       => 'nullable',
        'awards'           => 'nullable',
    ]);

    $user = Auth::user();
    $candidate = Candidate::where('account_id', $user->account_id)->first();

    if (!$candidate) {
        return back()->with('error', 'Vui lòng điền thông tin cá nhân trước!');
    }

    $resume = new Resume();
    $resume->candidate_id     = $candidate->candidate_id;
    $resume->resume_title     = $request->resume_title;
    
    $resume->category_id      = $request->category_id;
    $resume->job_type_id      = $request->job_type_id;
    $resume->level_id         = $request->level_id;

    $resume->career_objective = $request->career_objective;
    $resume->soft_skills      = $request->skills; 
    $resume->education        = $request->education;
    $resume->experience       = $request->experience;
    $resume->awards           = $request->awards;
    
    $resume->save();

    return redirect()->route('cv.templates', ['resume_id' => $resume->resume_id])
                     ->with('success', 'Khởi tạo thông tin nền tảng CV thành công!');
}

    public function apply($id)
    {
        $user = Auth::user();
        $job = JobPosting::findOrFail($id);
        $candidate = Candidate::where('account_id', $user->account_id)->first();

        if (!$candidate) {
            return back()->with('error', 'Không tìm thấy thông tin ứng viên.');
        }

        $resumes = Resume::where('candidate_id', $candidate->candidate_id)->get();
        return view('candidate.profile.apply', compact('job', 'candidate', 'resumes'));
    }

    // ================= 5. XỬ LÝ LƯU ĐƠN ỨNG TUYỂN =================
    // public function storeApply(Request $request, $id)
    // {
    //     $request->validate([
    //         'resume_id' => 'required|exists:resumes,resume_id'
    //     ]);

    //     $user = Auth::user();
    //     $candidate = Candidate::where('account_id', $user->account_id)->first();

    //     if (!$candidate) {
    //         return back()->with('error', 'Không thể thực hiện ứng tuyển.');
    //     }

    //     // Thực hiện lưu dữ liệu logic nộp đơn vào bảng applications tại đây...

    //     return redirect()->route('candidate.profile.index')->with('success', 'Nộp đơn ứng tuyển thành công!');
    // }
    public function storeApply(Request $request, $id)
    {
        $request->validate([

            'resume_id' => 'required'

        ]);

        $user = Auth::user();

        $candidate = Candidate::where(
            'account_id',
            $user->account_id
        )->first();

        if (!$candidate) {

            return back()->with(
                'error',
                'Không tìm thấy ứng viên'
            );
        }

        $application = new Application();

        $application->job_id = $id;

        $application->candidate_id =
            $candidate->candidate_id;

        $application->resume_id =
            $request->resume_id;

        $application->resume_link =
            $request->resume_link;

        $application->status = 0;
        $application->applied_date = now();

        $application->save();

        return redirect()
            ->route('profile')
            ->with(
                'success',
                'Ứng tuyển thành công!'
            );
    }
}