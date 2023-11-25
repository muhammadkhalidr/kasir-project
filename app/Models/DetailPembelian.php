<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;

    protected $detail_pembelians;
    protected $primaryKey = 'id_pembelian';

    public $incrementing = false;
    public $timestamps = true;
}
