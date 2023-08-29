<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'company_name',
        'email',
        'first_name',
        'last_name',
        'address_1',
        'address_2',
        'postal_code',
        'country_id',
        'city',
        'phone',
        'notes',
    ];
}
