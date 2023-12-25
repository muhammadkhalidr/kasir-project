<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasMasuk extends Model
{
    use HasFactory;

    protected $kas_masuks;
    protected $primaryKey = 'id';

    public $incrementing = false;
    public $timestamps = true;

    protected $fillable = [
        'id_generate',
        'pemasukan',
        'pengeluaran',
        'keterangan',
        'name_kasir',
        'bank'
    ];
}
