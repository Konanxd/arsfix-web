<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\User;
use App\Models\SparePart;
use App\Models\Transaction;

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
        // 'sparepart_id',
        'order_date',
        'status',
        'description',
        'estimated_cost',
        // 'jumlah',
    ];

    public function customer()
{
    return $this->belongsTo(Customers::class, 'customer_id');
}


    public function technician()
    {
        return $this->belongsTo(User::class, 'technician_id');
    }

    public function spareparts()
    {
        return $this->belongsToMany(SparePart::class, 'repair_order_spareparts')
                    ->withPivot('jumlah') // jika ada kolom jumlah di pivot
                    ->withTimestamps();
    }


    public function transaksi()
    {
        return $this->hasOne(Transaction::class, 'repair_id');
    }



}
