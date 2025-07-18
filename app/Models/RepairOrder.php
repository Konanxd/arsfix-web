<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairOrder extends Model
{
    use HasFactory;

    protected $table = 'repair_orders';
    protected $primaryKey = 'order_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'order_id',
        'customers_id',
        'technicians_id',
        'order_date',
        'status',
        'description',
        'estimated_cost',
        'completion_date',
    ];

    // Relasi ke Customer
    public function customer()
{
    return $this->belongsTo(Customers::class, 'customers_id', 'customers_id');
}

    // Relasi ke Technician
    public function technician()
    {
        return $this->belongsTo(Technician::class, 'technicians_id', 'technician_code');
    }
}
