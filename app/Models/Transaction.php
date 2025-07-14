<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $primaryKey = 'receipt_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'receipt_id',
        'order_id',
        'customer_id',
        'total_cost',
    ];

    // Relasi ke model Order
    public function order()
    {
        return $this->belongsTo(RepairOrder::class, 'order_id', 'id_pesanan');
    }

    // Relasi ke model Customer
    public function customer()
    {
        return $this->belongsTo(Customers::class, 'customer_id', 'id_pelanggan');
    }
}
