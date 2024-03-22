<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    protected $fillable = [
        'prd_name',
        'prd_image',
        'prd_quantity',
        'prd_price',
        'CategoryID',
        'created_by'
    ];
}
