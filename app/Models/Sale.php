<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = ['product_id', 'user_id', 'quantity'];

    // salesテーブルとproductsテーブルのリレーション
    public function user() {
        return $this->belongsTo(User::class);
    }
    
    // salesテーブルとproductsテーブルのリレーション
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
