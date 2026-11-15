<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * Model đại diện cho vai trò của tài khoản trong hệ thống.
 * Khai báo tên bảng, khóa chính và cấu hình thời gian tạo/cập nhật.
 */
class Role extends Model
{
   protected $table = 'roles';
    protected $primaryKey = 'role_id';
    public $timestamps = false;
}
