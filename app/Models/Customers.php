<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customers extends Model
{
    use HasFactory;

    protected $table = 'customers';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'phone_number',
    ];

    // Relasi ke repair orders
    public function repairOrders()
    {
        return $this->hasMany(RepairOrder::class, 'id', 'id');
    }
}

