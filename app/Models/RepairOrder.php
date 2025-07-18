<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairOrder extends Model
{
    use HasFactory;

    protected $table = 'repair_orders';

    // Kolom-kolom yang bisa diisi secara massal
    protected $fillable = [
        'customer_id',
        'technician_id',
        'sparepart_id',
        'order_date',
        'status',
        'description',
        'estimated_cost',
    ];

    /**
     * Relasi ke model Customers
     */
    public function customer()
    {
        return $this->belongsTo(Customers::class);
    }

    /**
     * Relasi ke model Technician
     */
    public function technician()
    {
        return $this->belongsTo(Technician::class);
    }

    /**
     * Relasi ke model SparePart
     */
    public function sparePart()
    {
        return $this->belongsTo(SparePart::class, 'sparepart_id');
    }
}
