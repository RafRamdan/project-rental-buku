<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mulct extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'mulct','mulct_price',
    ];
}
