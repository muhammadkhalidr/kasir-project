<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrderan extends Model
{
    use HasFactory;

    // protected $fillable = ['id_transaksi', 'kode_pelanggan', 'notrx', 'namapemesan', 'namabarang', 'keterangan', 'jumlah', 'harga', 'total', 'uangmuka', 'subtotal', 'sisa', 'status', 'name_kasir'];

    protected $guarded = ['id'];
    protected $table = 'detail_orderans';
    public function pelanggans()
    {
        return $this->belongsTo(Pelanggan::class, 'id_pelanggan');
    }
}
