<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
      protected $table='produk';
    protected $fillable =['nm_kuliner','jam_buka','jam_tutup','lokasi','telepon','alamat_maps','gambar','ket','status'];
    public $timestaps = false;
}
