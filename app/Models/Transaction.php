<?php

// app/Models/Transaction.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'receipt_id'; // contoh primary key
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'receipt_id',
        'repair_order_id',
        'customers_id',
        'total_price',
        'created_at',
    ];

    public function repairOrder() {
        return $this->belongsTo(RepairOrder::class, 'repair_order_id');
    }

    public function customer() {
        return $this->belongsTo(Customers::class, 'customers_id');
    }
}
