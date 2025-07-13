<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi';

    protected $primaryKey = 'id_struk';

    public $incrementing = false;      // Karena bukan auto increment

    protected $keyType = 'string';     // Karena primary key tipe string (VARCHAR)

    protected $fillable = [
        'id_struk',
        'id_pesanan',
        'id_pelanggan',
        'total_biaya',
    ];

    // Relasi ke pesananperbaikan
    public function pesanan()
    {
        return $this->belongsTo(PesananPerbaikan::class, 'id_pesanan', 'id_pesanan');
    }

    // Relasi ke pelanggan
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan', 'id_pelanggan');
    }
}
