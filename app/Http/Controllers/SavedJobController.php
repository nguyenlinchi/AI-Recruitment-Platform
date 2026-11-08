<?php

namespace App\Http\Controllers;

use App\Models\SavedJob;
use App\Models\Candidate;
use Illuminate\Support\Facades\Auth;

class SavedJobController extends Controller
{
    public function toggle($id)
{
    if (!Auth::check()) {

        return response()->json([
            'status' => 'login_required'
        ]);
    }

    $account = Auth::user();

    $candidate = Candidate::where(
        'account_id',
        $account->account_id
    )->first();

    if (!$candidate) {

        return response()->json([
            'status' => 'candidate_not_found'
        ]);
    }

    // KIỂM TRA ĐÃ SAVE CHƯA
    $savedJob = SavedJob::where(
            'candidate_id',
            $candidate->candidate_id
        )
        ->where('job_id', $id)
        ->first();

    // ĐÃ SAVE -> GỠ TIM
    if ($savedJob) {

        SavedJob::where(
                'candidate_id',
                $candidate->candidate_id
            )
            ->where('job_id', $id)
            ->delete();

        return response()->json([
            'status' => 'removed'
        ]);
    }

    // CHƯA SAVE -> THÊM
    SavedJob::create([
        'candidate_id' => $candidate->candidate_id,
        'job_id' => $id
    ]);

    return response()->json([
        'status' => 'saved'
    ]);
}

    // DANH SÁCH JOB ĐÃ LƯU
    public function index()
    {
        if (!Auth::check()) {

            return redirect('/login');
        }

        $account = Auth::user();

        $candidate = Candidate::where(
            'account_id',
            $account->account_id
        )->first();

        $savedJobs = SavedJob::with([
                'job.employer',
                'job.location',
                'job.salary',
                'job.jobType'
            ])
            ->where(
                'candidate_id',
                $candidate->candidate_id
            )
            ->latest()
            ->get();

        return view(
            'candidate.saved_jobs',
            compact('savedJobs')
        );
    }
}