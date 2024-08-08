<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    public function products()
    {
        return $this->hasMany(Product::class, 'attribute_id', 'id');
    }
}
