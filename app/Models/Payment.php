<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'reference',
        'amount',
        'description',
        'payment_method',
        'status',
        'logged_by',
    ];

    public function user(){
        return $this->belongsTo(User::class, 'logged_by');
    }
    
}
