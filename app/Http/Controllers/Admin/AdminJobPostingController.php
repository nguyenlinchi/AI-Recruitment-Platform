<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobPosting;

class AdminJobPostingController extends Controller
{
    /**
     * Hiển thị danh sách tin tuyển dụng trong trang quản trị.
     * Lấy kèm thông tin nhà tuyển dụng, danh mục, địa điểm,
     * loại công việc, mức lương và cấp bậc để hiển thị đầy đủ.
     */
    public function index()
    {
        $jobs = JobPosting::with([
            'employer',
            'category',
            'location',
            'jobType',
            'salary',
            'level'
        ])
        ->orderBy('posted_date', 'desc')
        ->get();

        return view('admin.job.index', compact('jobs'));
    }

    /**
     * Hiển thị thông tin chi tiết của một tin tuyển dụng.
     * Tìm tin theo ID và lấy kèm các dữ liệu liên quan.
     * Nếu không tìm thấy tin tuyển dụng, hệ thống trả về lỗi 404.
     */
    public function show($id)
    {
        $job = JobPosting::with([
            'employer',
            'category',
            'location',
            'jobType',
            'salary',
            'level'
        ])->findOrFail($id);

        return view('admin.job.show', compact('job'));
    }

    /**
     * Cập nhật trạng thái của tin tuyển dụng.
     * Nhận trạng thái mới từ yêu cầu, lưu vào cơ sở dữ liệu
     * và quay lại trang trước kèm thông báo kết quả.
     */
    public function updateStatus(Request $request, $id)
    {
        $job = JobPosting::findOrFail($id);

        $job->status = $request->status;
        $job->save();

        return back()->with(
            'success',
            'Cập nhật trạng thái thành công'
        );
    }

    /**
     * Xóa tin tuyển dụng theo ID.
     * Sau khi xóa, quay lại trang trước và hiển thị thông báo.
     */
    public function destroy($id)
    {
        JobPosting::destroy($id);

        return back()->with(
            'success',
            'Xóa job thành công'
        );
    }
}
