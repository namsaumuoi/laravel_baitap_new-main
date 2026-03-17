<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
        'image',
        'parent_id',
        'is_active',
        'is_delete'
    ];

    // Quan hệ: category này thuộc về category cha
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Quan hệ: category này có nhiều category con
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Lấy tất cả con cháu (dùng để chặn vòng lặp)
    public function descendants()
    {
        return $this->children()->with('descendants');
    }
}
