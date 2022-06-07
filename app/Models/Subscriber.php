<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address_id',
        'phone',
        'email',
        'id_number',
        'tax_number',
    ];
}

