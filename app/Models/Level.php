<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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