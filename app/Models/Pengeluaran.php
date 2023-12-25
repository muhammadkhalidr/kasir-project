<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengeluaran extends Model
{
    use HasFactory;

    protected $pengeluarans;
    protected $primaryKey = 'id_pengeluaran';

    protected $fillable = [
        'id_pengeluaran',
        'id_generate',
        'keterangan',
        'jumlah',
        'harga',
        'total',
        'created_at',
        'updated_at',
    ];

    public $incrementing = false;
    public $timestamps = true;

    public function kasMasuk()
    {
        return $this->hasOne(KasMasuk::class, 'id_generate', 'total');
    }
}
