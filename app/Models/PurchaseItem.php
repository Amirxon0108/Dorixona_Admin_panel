<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseItem extends Model
{
    use HasFactory;

    protected $fillable=[
        'purchase_id','medicine_id','quantity','unit_price','description','expiry_date', 'batch_no'
    ];


    public function purchase()
    {
        return $this->belongsTo(Purchase::class);
    }
    public function medicine()
    {
        return $this->belongsTo(Medicine::class);
    }
}
