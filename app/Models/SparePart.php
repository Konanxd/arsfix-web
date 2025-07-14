<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SparePart extends Model
{
    use HasFactory;

    protected $table = 'spare_parts';
    protected $primaryKey = 'parts_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'parts_id',
        'name_parts',
        'price',
        'stock',
    ];
}
