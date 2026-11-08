<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CareerGuideSection extends Model
{
    protected $table = 'career_guide_sections';
    public $timestamps = false;

    protected $fillable = ['guide_id', 'title', 'content', 'sort_order'];
}   
