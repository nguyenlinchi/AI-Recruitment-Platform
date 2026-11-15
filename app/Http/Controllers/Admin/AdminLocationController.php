<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class AdminLocationController extends Controller
{
    /**
     * Lấy danh sách tất cả địa điểm làm việc
     * và truyền dữ liệu sang giao diện quản lý địa điểm.
     */
    public function index()
    {
        $items = Location::all();

        return view('admin.locations.index', compact('items'));
    }
    /**
     * Tiếp nhận thông tin từ biểu mẫu và tạo địa điểm làm việc mới.
     */
    public function store(Request $request)
    {
        Location::create([
            'location_name' => $request->location_name
        ]);

        return back();
    }
    /**
     * Tìm địa điểm theo ID và cập nhật lại tên địa điểm.
     * $id ID của địa điểm cần cập nhật
     */
    public function update(Request $request, $id)
    {
        Location::findOrFail($id)->update([
            'location_name' => $request->location_name
        ]);

        return back();
    }
    /**
     * Xóa địa điểm làm việc theo ID được cung cấp.
     * $id ID của địa điểm cần xóa
     */
    public function destroy($id)
    {
        Location::destroy($id);

        return back();
    }
}