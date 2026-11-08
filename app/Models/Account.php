<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Account extends Authenticatable
{
    protected $table = 'accounts';
    protected $primaryKey = 'account_id';

    protected $fillable = [
        'name','email', 'password', 'role_id'
    ];

    protected $hidden = [
        'password'
    ];

    // 👇 THÊM ĐOẠN NÀY
    public function getAuthPassword()
    {
        return $this->password;
    }

    // quan hệ role
    public function role() {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function candidate()
        {
            return $this->hasOne(
                Candidate::class,
                'account_id',
                'account_id'
            );
        }
 public function employer()
    {
        return $this->hasOne(Employer::class, 'account_id');
    }
}