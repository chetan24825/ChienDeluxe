<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function wishlist()
    {
        return $this->belongsTo(Wishlist::class);
    }
    
     public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id');
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rate') ?? 4; // Return 0 if no reviews
    }
}
