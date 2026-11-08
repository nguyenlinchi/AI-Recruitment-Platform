<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;
use App\Models\Application;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApplicationApprovedMail;

class ApplicationController extends EmployerBaseController
{
    public function index(Request $request)
    {
        $employer = $this->getEmployer();

        $jobIds = JobPosting::where(
            'employer_id',
            $employer->employer_id
        )->pluck('job_id');

        $applications = Application::whereIn('job_id', $jobIds)

            // search candidate
            ->when($request->candidate, function ($q) use ($request) {

                $q->whereHas('candidate', function ($sub) use ($request) {

                    $sub->where(
                        'full_name',
                        'like',
                        '%' . $request->candidate . '%'
                    );
                });
            })

            // search job
            ->when($request->job, function ($q) use ($request) {

                $q->whereHas('job', function ($sub) use ($request) {

                    $sub->where(
                        'job_title',
                        'like',
                        '%' . $request->job . '%'
                    );
                });
            })

            ->orderBy('applied_date', 'desc')
            ->get();

        return view(
            'employer.applications.index',
            compact('applications')
        );
    }

    public function show($id)
    {
        $app = Application::with(['candidate', 'resume'])->findOrFail($id);

        return view('employer.applications.show', compact('app'));
    }

    public function updateStatus(Request $request, $id)
    {
        $app = Application::findOrFail($id);

        // cập nhật trạng thái
        $app->status = $request->status;
        $app->save();

        // Nếu duyệt
        if ($request->status == 1) {

            $candidate = $app->candidate;

            $job = $app->job;

            // email ứng viên
            $candidateEmail = $candidate->account->email;

            // email employer
            $employerEmail = $job->employer->account->email;

            // gửi mail
            Mail::to($candidateEmail)
                ->send(
                    new ApplicationApprovedMail(
                        $candidate,
                        $job,
                        $employerEmail
                    )
                );
        }

        return back()->with('success', 'Cập nhật trạng thái thành công');
    }
}
