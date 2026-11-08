<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerCategory extends Model
{
    protected $table = 'career_categories';
    protected $primaryKey = 'category_id';
    public $timestamps = false;
}
