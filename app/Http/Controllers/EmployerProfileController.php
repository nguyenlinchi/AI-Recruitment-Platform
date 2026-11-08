<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class EmployerProfileController extends EmployerBaseController
{
    public function index()
    {
        $employer = $this->getEmployer();
        return view('employer.profile.index', compact('employer'));
    }

    public function edit()
    {
        $employer = $this->getEmployer();
        return view('employer.profile.edit', compact('employer'));
    }

    public function update(Request $request)
    {
        $employer = $this->getEmployer();

        $request->validate([
            'company_name' => 'required',
            'contact_name' => 'required',
            'phone' => 'required',
            'avatar' => 'nullable|image',
            'cover_image' => 'nullable|image'
        ]);

        // Upload avatar lên Cloudinary
        if ($request->hasFile('avatar')) {

            $avatarUrl = Cloudinary::upload(
                $request->file('avatar')->getRealPath(),
                [
                    'folder' => 'job_web/avatar'
                ]
            )->getSecurePath();

            $employer->avatar = $avatarUrl;
        }

        // Upload cover lên Cloudinary
        if ($request->hasFile('cover_image')) {

            $coverUrl = Cloudinary::upload(
                $request->file('cover_image')->getRealPath(),
                [
                    'folder' => 'job_web/cover'
                ]
            )->getSecurePath();

            $employer->cover_image = $coverUrl;
        }

        // Update dữ liệu
        $employer->update([
            'company_name' => $request->company_name,
            'contact_name' => $request->contact_name,
            'position' => $request->position,
            'phone' => $request->phone,
            'description' => $request->description,
            'website' => $request->website,
            'location' => $request->location,
            'company_size' => $request->company_size,
            'founded_year' => $request->founded_year,
            'avatar' => $employer->avatar,
            'cover_image' => $employer->cover_image
        ]);

        return redirect('/employer/profile')
            ->with('success', 'Cập nhật thành công');
    }
}
