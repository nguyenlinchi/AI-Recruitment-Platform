<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;

class AdminSalaryController extends Controller
{
    public function index()
    {
        $items = Salary::all();

        return view('admin.salaries.index', compact('items'));
    }

    public function store(Request $request)
    {
        Salary::create([
            'salary_range' => $request->salary_range
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        Salary::findOrFail($id)->update([
            'salary_range' => $request->salary_range
        ]);

        return back();
    }

    public function destroy($id)
    {
        Salary::destroy($id);

        return back();
    }
}