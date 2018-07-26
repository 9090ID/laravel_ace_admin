<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sub_kategori extends Model
{
    protected $table='sub_katagori';
    protected $fillable =['nama_sub_kategori','status'];
    public $timestaps = false;
}
