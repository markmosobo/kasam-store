<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;
use App\Models\User;

class Purchase extends Model
{
    use HasFactory;
    protected $fillable =
    [
     'product_id',
     'pieces',
     'amount_payable',
     'amount_paid',
     'payment_type',
     'mpesa_code',
     'created_by',
     'comments'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
