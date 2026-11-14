<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Model đại diện cho danh mục bài viết hướng nghiệp.
 * Khai báo tên bảng, khóa chính và cấu hình thời gian tạo/cập nhật.
 */
class CareerCategory extends Model
{
    protected $table = 'career_categories';
    protected $primaryKey = 'category_id';
    public $timestamps = false;
}
