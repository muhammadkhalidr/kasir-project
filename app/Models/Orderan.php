<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orderan extends Model
{
    use HasFactory;

    protected $orderans;
    protected $primaryKey = 'id_keuangan';

    public $incrementing = false;
    public $timestamps = true;
}
