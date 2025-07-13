<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['id_pelanggan', 'nama_pelanggan', 'no_hp', 'handphone'];
}
