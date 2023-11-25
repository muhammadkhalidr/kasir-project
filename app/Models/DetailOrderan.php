<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrderan extends Model
{
    use HasFactory;

    protected $fillable = ['id_transaksi', 'notrx', 'namapemesan', 'namabarang', 'jumlah', 'harga', 'total', 'uangmuka', 'subtotal', 'sisa', 'status'];
}
