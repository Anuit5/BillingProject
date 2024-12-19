<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
    ];

    // Define the relationship with Purchase
    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }

    // Define the relationship with Product
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }
}