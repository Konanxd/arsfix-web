<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SukuCadang extends Model
{
    protected $table = 'suku_cadang';
    protected $primaryKey = 'id_part';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['id_part', 'nama_part', 'harga', 'stok'];
}
