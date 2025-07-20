<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairOrder extends Model
{
    use HasFactory;

    protected $table = 'repair_orders';
    protected $primaryKey = 'id';
    public $incrementing = true;


    protected $fillable = [
        'id',
        'customer_id',
        'technician_id',
        'sparepart_id',
        'order_date',
        'status',
        'description',
        'estimated_cost',
        'jumlah',
    ];

    public function customer()
{
    return $this->belongsTo(Customers::class, 'customer_id');
}


    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function sparePart()
    {
        return $this->belongsTo(SparePart::class, 'sparepart_id');
    }
    public function transaksi()
{
    return $this->belongsTo(Customers::class, 'repair_id');
}


}
