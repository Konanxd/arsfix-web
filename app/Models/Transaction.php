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
        'repair_id',
        'spare_part_cost',
        'service_fee',
        'total_payment',
    ];

    public function repairOrder()
    {
        return $this->belongsTo(RepairOrder::class, 'repair_id');
    }

    // Jika ingin fungsi helper untuk customer (bukan relasi), buat seperti ini:
    public function getCustomerAttribute()
    {
        return $this->repairOrder ? $this->repairOrder->customer : null;
    }
}
