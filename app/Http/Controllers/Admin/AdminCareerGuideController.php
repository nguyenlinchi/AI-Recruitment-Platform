<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CareerGuide;
use App\Models\CareerCategory;
use Illuminate\Support\Str;

use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class AdminCareerGuideController extends Controller
{
    // ================= INDEX =================
    public function index()
    {
        $careers = CareerGuide::with('category')
            ->latest()
            ->get();

        $categories = CareerCategory::all();

        return view(
            'admin.career_guides.index',
            compact('careers', 'categories')
        );
    }

    // ================= STORE =================
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'summary' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'thumbnail' => 'required|image'
        ]);

        $imageUrl = null;

        // upload image
        if ($request->hasFile('thumbnail')) {

            $upload = Cloudinary::upload(
                $request->file('thumbnail')->getRealPath(),
                [
                    'folder' => 'career_guides'
                ]
            );

            $imageUrl = $upload->getSecurePath();
        }

        CareerGuide::create([

            'title' => $request->title,

            'slug' => Str::slug($request->title),

            'summary' => $request->summary,

            'content' => $request->content,

            'thumbnail' => $imageUrl,

            'account_id' => 1,

            'category_id' => $request->category_id,

            'views' => 0,

            'is_featured' => 0,

            'status' => 1
        ]);

        return back()->with(
            'success',
            'Thêm thành công'
        );
    }

    // ================= UPDATE =================
    public function update(Request $request, $id)
    {
        $career = CareerGuide::findOrFail($id);

        $imageUrl = $career->thumbnail;

        // upload new image
        if ($request->hasFile('thumbnail')) {

            $upload = Cloudinary::upload(
                $request->file('thumbnail')->getRealPath(),
                [
                    'folder' => 'career_guides'
                ]
            );

            $imageUrl = $upload->getSecurePath();
        }

        $career->update([

            'title' => $request->title,

            'slug' => Str::slug($request->title),

            'summary' => $request->summary,

            'content' => $request->content,

            'thumbnail' => $imageUrl,

            'category_id' => $request->category_id,

            'status' => $request->status
        ]);

        return back()->with(
            'success',
            'Cập nhật thành công'
        );
    }

    // ================= DELETE =================
    public function destroy($id)
    {
        CareerGuide::destroy($id);

        return back()->with(
            'success',
            'Xóa thành công'
        );
    }
}