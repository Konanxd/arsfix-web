<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\RepairOrder;

class Transaction extends Model
{
    protected $table = 'transactions';
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'id',
        'repair_id',
        'total_payment',
    ];

    public function repairOrder()
    {
        return $this->belongsTo(RepairOrder::class, 'repair_id');
    }

    // Akses pelanggan melalui pesanan perbaikan
    public function customer()
    {
        return $this->repairOrder->customer;
    }
}
