<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';
    protected $primaryKey = 'customers_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'customers_id',
        'name_customers',
        'phone_number',
        'handphone',
    ];

    // Relasi ke repair orders
    public function repairOrders()
    {
        return $this->hasMany(RepairOrder::class, 'customers_id', 'customers_id');
    }
}

