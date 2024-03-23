<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Invoice extends Model
{
    use HasFactory;
    protected $fillable = ['ref_no','items_no','status', 'payment_method','amount_paid','change','mpesa_code','created_by','amount_due'];

    public function user()
    {
        return $this->belongsTo(User::class,'created_by');
    }

}
