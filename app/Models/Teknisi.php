<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teknisi extends Model
{
    protected $table = 'teknisi';
    protected $primaryKey = 'id_teknisi';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['id_teknisi', 'nama_teknisi', 'data_login'];
}
