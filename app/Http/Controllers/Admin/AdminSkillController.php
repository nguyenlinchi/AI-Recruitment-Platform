<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class AdminSkillController extends Controller
{
    public function index()
    {
        $items = Skill::all();

        return view('admin.skills.index', compact('items'));
    }

    public function store(Request $request)
    {
        Skill::create([
            'skill_name' => $request->skill_name
        ]);

        return back();
    }

    public function update(Request $request, $id)
    {
        Skill::findOrFail($id)->update([
            'skill_name' => $request->skill_name
        ]);

        return back();
    }

    public function destroy($id)
    {
        Skill::destroy($id);

        return back();
    }
}