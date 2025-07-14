<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Technician extends Model
{
    use HasFactory;

    protected $table = 'technicians';
    protected $primaryKey = 'technicians_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'technicians_id',
        'name_technicians',
        'login_data',
    ];

    // Relasi ke repair orders (jika berlaku)
    public function repairOrders()
    {
        return $this->hasMany(RepairOrder::class, 'technicians_id', 'technicians_id');
    }
}
