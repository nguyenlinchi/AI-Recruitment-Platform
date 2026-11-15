<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
/**
 * Model đại diện cho danh mục ngành nghề tuyển dụng.
 * Khai báo bảng dữ liệu, khóa chính, các trường được phép lưu
 * và mối quan hệ với các tin tuyển dụng.
 */
class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public $timestamps = false;

    protected $fillable = ['
        category_name',
        'image'
    ];

    // Quan hệ với job
    /**
     * Lấy danh sách tin tuyển dụng thuộc danh mục này.
     */
    public function jobs()
    {
        return $this->hasMany(JobPosting::class, 'category_id');
    }
}