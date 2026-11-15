<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobType;

class AdminJobTypeController extends Controller
{
    /**
     * Hiển thị danh sách các loại công việc.
     * Lấy toàn bộ dữ liệu từ bảng JobType và chuyển sang giao diện quản trị.
     */
    public function index()
    {
        $items = JobType::all();

        return view('admin.job_types.index', compact('items'));
    }

    /**
     * Thêm một loại công việc mới vào hệ thống.
     * Tiếp nhận tên loại công việc từ biểu mẫu và lưu vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        JobType::create([
            'job_type_name' => $request->job_type_name
        ]);

        return back();
    }

    /**
     * Cập nhật tên của loại công việc đã tồn tại.
     * Tìm bản ghi theo ID, thay đổi tên và lưu lại thông tin mới.
     */
    public function update(Request $request, $id)
    {
        JobType::findOrFail($id)->update([
            'job_type_name' => $request->job_type_name
        ]);

        return back();
    }

    /**
     * Xóa loại công việc theo ID.
     * Sau khi xóa, quay lại trang quản trị trước đó.
     */
    public function destroy($id)
    {
        JobType::destroy($id);

        return back();
    }
}
