<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutInfo extends Model
{
    use HasFactory;
    protected $fillable = ['address','phone1','phone2', 'email','kra_pin', 'vat'];

}
