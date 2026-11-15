<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Salary;

class AdminSalaryController extends Controller
{
    /**
     * Hiển thị danh sách các khoảng mức lương trong hệ thống.
     * Lấy toàn bộ dữ liệu từ bảng Salary và chuyển sang giao diện quản trị.
     */
    public function index()
    {
        $items = Salary::all();

        return view('admin.salaries.index', compact('items'));
    }

    /**
     * Thêm một khoảng mức lương mới.
     * Nhận giá trị khoảng lương từ biểu mẫu và lưu vào cơ sở dữ liệu.
     */
    public function store(Request $request)
    {
        Salary::create([
            'salary_range' => $request->salary_range
        ]);

        return back();
    }

    /**
     * Cập nhật thông tin khoảng mức lương theo ID.
     * Tìm bản ghi cần sửa, cập nhật giá trị mới và lưu lại.
     */
    public function update(Request $request, $id)
    {
        Salary::findOrFail($id)->update([
            'salary_range' => $request->salary_range
        ]);

        return back();
    }

    /**
     * Xóa khoảng mức lương theo ID.
     * Sau khi thực hiện, quay lại trang quản trị trước đó.
     */
    public function destroy($id)
    {
        Salary::destroy($id);

        return back();
    }
}
