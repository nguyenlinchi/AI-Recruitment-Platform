<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobPosting;
use App\Models\Category;
use App\Models\JobType;
use App\Models\Salary;
use App\Models\Level;
use App\Models\Location;

class JobPostingController extends EmployerBaseController
{
    // ================= LIST =================
    /*public function index()
    {
        $employer = $this->getEmployer();

        $jobs = JobPosting::where('employer_id', $employer->employer_id)
            ->orderBy('posted_date', 'desc')
            ->get();

        return view('employer.jobs.index', compact('jobs'));
    }*/

    public function index(Request $request)
    {
        $employer = $this->getEmployer();

        $jobs = JobPosting::where(
            'employer_id',
            $employer->employer_id
        )

            // SEARCH
            ->when($request->keyword, function ($q) use ($request) {

                $q->where(
                    'job_title',
                    'like',
                    '%' . $request->keyword . '%'
                );
            })

            // STATUS
            ->when(
                $request->status !== null &&
                    $request->status !== '',

                function ($q) use ($request) {

                    $q->where(
                        'status',
                        $request->status
                    );
                }
            )

            ->orderBy('job_id', 'desc')

            ->get();

        return view(
            'employer.jobs.index',
            compact('jobs')
        );
    }

    // ================= CREATE =================
    public function create()
    {
        return view('employer.jobs.create', [
            'categories' => Category::all(),
            'jobTypes' => JobType::all(),
            'salaries' => Salary::all(),
            'levels' => Level::all(),
            'locations' => Location::all()
        ]);
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $employer = $this->getEmployer();

        $request->validate([
            'job_title' => 'required|max:255',
            'category_id' => 'required',
            'job_type_id' => 'required',
            'salary_id' => 'required',
            'level_id' => 'required',
            'location_id' => 'required',
            'job_description' => 'required',
            'candidate_requirements' => 'required',
            'deadline' => 'required|date'
        ]);

        JobPosting::create([
            'employer_id' => $employer->employer_id,
            'job_title' => $request->job_title,
            'category_id' => $request->category_id,
            'job_type_id' => $request->job_type_id,
            'salary_id' => $request->salary_id,
            'level_id' => $request->level_id,
            'location_id' => $request->location_id,
            'workplace' => $request->workplace,
            'quantity' => $request->quantity,
            'gender_requirement' => $request->gender,
            'job_description' => $request->job_description,
            'candidate_requirements' => $request->candidate_requirements,
            'benefits' => $request->benefits,
            'deadline' => $request->deadline,
            'posted_date' => now(),
            'status' => 0
        ]);

        return redirect('/employer/jobs')->with('success', 'Đăng tuyển thành công');
    }

    // ================= EDIT =================
    public function edit($id)
    {
        $employer = $this->getEmployer();

        $job = JobPosting::where('job_id', $id)
            ->where('employer_id', $employer->employer_id)
            ->firstOrFail();

        return view('employer.jobs.edit', [
            'job' => $job,
            'categories' => Category::all(),
            'jobTypes' => JobType::all(),
            'salaries' => Salary::all(),
            'levels' => Level::all(),
            'locations' => Location::all()
        ]);
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $employer = $this->getEmployer();

        $job = JobPosting::where('job_id', $id)
            ->where('employer_id', $employer->employer_id)
            ->firstOrFail();

        $data = $request->validate([
            'job_title' => 'required|max:255',
            'category_id' => 'required',
            'job_type_id' => 'required',
            'salary_id' => 'required',
            'level_id' => 'required',
            'location_id' => 'required',
            'workplace' => 'nullable',
            'quantity' => 'nullable|numeric',
            'gender_requirement' => 'nullable',
            'job_description' => 'required',
            'candidate_requirements' => 'required',
            'benefits' => 'nullable',
            'deadline' => 'required|date',
            'status' => 'required'
        ]);

        $job->update($data);

        return redirect('/employer/jobs')->with('success', 'Cập nhật thành công');
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        $employer = $this->getEmployer();

        JobPosting::where('job_id', $id)
            ->where('employer_id', $employer->employer_id)
            ->delete();

        return back()->with('success', 'Xóa thành công');
    }
}
