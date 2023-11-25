<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPengeluaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_pengeluaran',
        'keterangan',
        'harga',
        'total',
    ];

    protected $detail_pengeluarans;
    protected $primaryKey = 'id';

    public $timestamps = true;
}
