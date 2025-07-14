<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customers extends Model
{
    use HasFactory;

    protected $primaryKey = 'customers_id';
 
    protected $keyType = 'string';

    protected $fillable = ['customers_id', 'name_customers', 'phone_number', 'handphone'];
}

