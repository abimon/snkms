<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'discount',
        'isDelivered',
        'delivery_date',
        'receipt_no',
        'isPaid'
    ];
    public function product(){
        return $this->belongsTo(Catalog::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
