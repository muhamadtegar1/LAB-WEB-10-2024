<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'stock', 'category_id'];

    public function Category(){
        return $this->belongsTo(Category::class);
    }
    public function InventoryLog(){
        return $this->hasMany(InventoryLog::class);
    }
}