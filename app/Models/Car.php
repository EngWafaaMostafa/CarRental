<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Category;

class Car extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title', 'content', 'luggage', 'doors', 'passengers', 'price', 'active', 'image', 'category_id']; //another way to insert
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
