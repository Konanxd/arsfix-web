<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;

    protected $table = 'spare_parts';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'name',
        'price',
        'stock',
        'image'
    ];

    public function repairOrders()
    {
        return $this->belongsToMany(RepairOrder::class, 'repair_order_spareparts')
                    ->withPivot('jumlah')
                    ->withTimestamps();
    }
    
}
