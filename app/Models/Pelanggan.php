<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'kode_pelanggan',
        'nama',
        'alamat',
        'nohp',
        'email',
    ];

    public function detailOrderans()
    {
        return $this->hasMany(DetailOrderan::class, 'id');
    }
}
