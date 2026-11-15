<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;

class AdminSkillController extends Controller
{
    /**
     * Hiển thị danh sách kỹ năng tuyển dụng.
     * Lấy toàn bộ dữ liệu kỹ năng từ cơ sở dữ liệu
     * và chuyển sang giao diện quản lý kỹ năng.
     */
    public function index()
    {
        $items = Skill::all();

        return view('admin.skills.index', compact('items'));
    }

    /**
     * Thêm một kỹ năng mới vào hệ thống.
     * Tiếp nhận tên kỹ năng từ biểu mẫu và lưu vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        Skill::create([
            'skill_name' => $request->skill_name
        ]);

        return back();
    }

    /**
     * Cập nhật tên kỹ năng theo ID.
     * Tìm kỹ năng cần chỉnh sửa, cập nhật tên mới và lưu lại.
     */
    public function update(Request $request, $id)
    {
        Skill::findOrFail($id)->update([
            'skill_name' => $request->skill_name
        ]);

        return back();
    }

    /**
     * Xóa kỹ năng khỏi hệ thống theo ID.
     * Sau khi xóa, quay lại trang quản trị trước đó.
     */
    public function destroy($id)
    {
        Skill::destroy($id);

        return back();
    }
}
