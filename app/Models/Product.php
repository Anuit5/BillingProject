<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'product_id', 'available_stocks', 'price_per_unit', 'tax_percentage'];


    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class, 'product_id', 'product_id');
    }
    public function priceWithTax() {
        return $this->price + ($this->price * ($this->taxPercentage / 100));
    }
    
}
