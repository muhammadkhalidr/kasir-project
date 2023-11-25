<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GajiKaryawan extends Model
{
    use HasFactory;

    protected $gaji_karyawans;
    protected $primaryKey = 'id_gaji';

    public $incrementing = false;
    public $timestamps = true;
}
