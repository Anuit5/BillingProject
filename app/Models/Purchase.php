<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable = [
        'customer_email',
        'total_amount',
        'cash_paid',
        'change_due',
    ];

    public function purchaseItems()
    {
        return $this->hasMany(PurchaseItem::class);
    }
}
