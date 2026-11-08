<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobType;

class AdminJobTypeController extends Controller
{
    public function index()
    {
        $items = JobType::all();

        return view('admin.job_types.index', compact('items'));
    }

    public function store(Request $request)
    {
        JobType::create([
            'job_type_name' => $request->job_type_name
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        JobType::findOrFail($id)->update([
            'job_type_name' => $request->job_type_name
        ]);

        return back();
    }

    public function destroy($id)
    {
        JobType::destroy($id);

        return back();
    }
}