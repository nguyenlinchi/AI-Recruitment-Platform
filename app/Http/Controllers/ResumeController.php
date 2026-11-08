<?php

namespace App\Http\Controllers;

use App\Models\Resume;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class ResumeController extends Controller
{
    public function preview($resume_id, $template)
    {
        $resume = Resume::with('candidate')->findOrFail($resume_id);

        // Danh sách template hợp lệ
        $allowedTemplates = ['professional', 'professional1', 'professional2', 'professional3'];

        if (!in_array($template, $allowedTemplates)) {
            $template = 'professional'; 
        }

        return view("candidate.cv.templates.{$template}", compact('resume'));
    }

public function downloadPDF($resume_id, $template = 'professional')
{
    $resume = Resume::with('candidate')->findOrFail($resume_id);
    $resume->refresh();

    $allowedTemplates = ['professional', 'professional1', 'professional2', 'professional3'];
    if (!in_array($template, $allowedTemplates)) {
        $template = 'professional';
    }

    $pdf = Pdf::loadView("candidate.cv.templates.{$template}", compact('resume'))
              ->setPaper('a4', 'portrait')
              ->setOptions([
                  'isHtml5ParserEnabled'   => true,
                  'isRemoteEnabled'        => false, 
                  'isFontSubsettingEnabled'=> false, 
                  'defaultFont'            => 'DejaVuSans', 
                  'isPhpEnabled'           => false,
                  'dpi'                    => 150,
                  'enable-javascript'      => false, 
              ]);


    $filename = 'CV_' . str_replace([' ', '/', '\\'], '_', 
                $resume->full_name ?? $resume->candidate->full_name ?? 'Ung_Vien') . '.pdf';

    return $pdf->download($filename);
}
public function saveEdited(Request $request, $resume_id)
{
    $resume = Resume::findOrFail($resume_id);
    $user = auth()->user();

    $currentCandidateId = ($user && $user->candidate) ? $user->candidate->candidate_id : null;

    if ($resume->candidate_id !== $currentCandidateId) {
        return response()->json([
            'success' => false, 
            'message' => 'Bạn không có quyền chỉnh sửa CV này.'
        ], 403);
    }

    $resume->update([
        'full_name'        => $request->full_name,
        'resume_title'     => $request->resume_title,
        'career_objective' => $request->career_objective,
        'soft_skills'      => $request->soft_skills,
        'phone'            => $request->phone,
        'address'          => $request->address,
        'experience'       => $request->experience,
        'education'        => $request->education,
        'awards'           => $request->awards,
    ]);

    return response()->json(['success' => true, 'message' => 'CV đã được lưu thành công']);
}
public function edit($id)
    {
        $resume = Resume::findOrFail($id);

        return view('candidate.profile.edit', compact('resume'));
    }

    public function update(Request $request, $id)
    {
        $resume = Resume::findOrFail($id);

        $resume->update([
            'resume_title'      => $request->resume_title,
            'career_objective'  => $request->career_objective,
            'experience'        => $request->experience,
            'education'         => $request->education,
            'soft_skills'       => $request->soft_skills,
            'awards'            => $request->awards,
        ]);

        return redirect()
            ->route('profile')
            ->with('success', 'Cập nhật CV thành công!');
    }

    public function show($id)
    {
        $resume = Resume::findOrFail($id);

        return view('candidate.profile.show', compact('resume'));
    }
}
