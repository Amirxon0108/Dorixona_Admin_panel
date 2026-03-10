<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'invoice_number',
        'sub_total',
        'discount',
        'total_amount',
        'payment_method',
        'status',
        'note',
    ];

    public function items(){
        return $this->hasMany(SalesItem::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }



}
