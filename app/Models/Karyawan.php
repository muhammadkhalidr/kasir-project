<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;

    protected $karyawans;
    protected $primaryKey = 'id_karyawan';

    public $incrementing = false;
    public $timestamps = true;
}
