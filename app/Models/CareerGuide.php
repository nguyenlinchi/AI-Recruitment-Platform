<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CareerGuide extends Model
{
    protected $table = 'career_guides';

    protected $primaryKey = 'guide_id';

    // PHẢI bật timestamps
    public $timestamps = true;

    protected $fillable = [
        'title',
        'slug',
        'summary',
        'thumbnail',
        'account_id',
        'category_id',
        'views',
        'is_featured',
        'status'
    ];

    // ép kiểu ngày giờ
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // ======================
    // RELATIONSHIPS
    // ======================

    public function category()
    {
        return $this->belongsTo(
            CareerCategory::class,
            'category_id'
        );
    }

    public function sections()
    {
        return $this->hasMany(
            CareerGuideSection::class,
            'guide_id'
        );
    }

    public function tags()
    {
        return $this->belongsToMany(
            Tag::class,
            'career_guide_tag',
            'guide_id',
            'tag_id'
        );
    }
}