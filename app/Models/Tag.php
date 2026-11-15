<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Model đại diện cho các thẻ kỹ năng hoặc từ khóa trong hệ thống.
 * Khai báo tên bảng, khóa chính và cấu hình thời gian tạo/cập nhật.
 */
class Tag extends Model
{
    protected $table = 'tags';
    protected $primaryKey = 'tag_id';
    public $timestamps = false;
}
