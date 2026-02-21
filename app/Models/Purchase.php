<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable=[
        'supplier_id','user_id','purchase_no','purchase_date','total_amount','description'
    ];
}
