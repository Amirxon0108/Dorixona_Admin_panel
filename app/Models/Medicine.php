<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'generic_name',
        'description',
        'barcode',
        'category_id',
        'buy_price',
        'sell_price',
        'quantity',
        'min_stock',
        'expiry_date',
        'image',
        'is_active'
    ];

    public function category(){
        return $this->belongsTo( Category::class);
    }
}
