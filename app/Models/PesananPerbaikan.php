<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesananPerbaikan extends Model
{
    use HasFactory;

    protected $table = 'pesananperbaikan'; // nama tabel, jika beda dari default

    protected $primaryKey = 'id_pesanan'; // primary key

    public $incrementing = false; // karena primary key varchar, bukan auto increment

    protected $keyType = 'string'; // tipe primary key string (varchar)

    protected $fillable = [
        'id_pesanan',
        'id_pelanggan',
        'id_teknisi',
        'tgl_order',
        'status',
        'deskripsi',
        'estimasi_biaya',
        'tgl_selesai',
    ];
}
