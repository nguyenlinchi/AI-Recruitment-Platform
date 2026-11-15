<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Model đại diện cho cấp bậc hoặc trình độ công việc.
 * Khai báo bảng dữ liệu và mối quan hệ với các tin tuyển dụng.
 */
class Level extends Model
{
    protected $table = 'levels'; // tên bảng
    protected $primaryKey = 'level_id'; // khóa chính
    public $timestamps = false; // nếu bảng không có created_at, updated_at

    // 🔹 Quan hệ: 1 level có nhiều job
    public function jobs()
    {
        return $this->hasMany(JobPosting::class, 'level_id');
    }
}