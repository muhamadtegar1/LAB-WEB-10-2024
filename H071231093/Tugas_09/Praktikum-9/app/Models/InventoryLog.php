<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryLog extends Model
{
    protected $fillable = ['product_id', 'type', 'quantity'];

    public function Product(){
        return $this->belongsTo(Product::class);
    }
}