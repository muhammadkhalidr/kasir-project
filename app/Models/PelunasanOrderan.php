<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PelunasanOrderan extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'id_orderan',
        'notrx',
        'total_bayar',
        'created_at',
        'updated_at',
        'bank',
        'bukti_transfer',
        'id_bayar'
    ];
}
