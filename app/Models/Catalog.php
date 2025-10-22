<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $fillable = [
        "name",
        "price",
        "units",
        "category",
        "description",
        "sales",
        "isAvailable",
        "discount",
        "cover"
    ];
}
