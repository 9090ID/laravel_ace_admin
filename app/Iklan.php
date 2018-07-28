<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iklan extends Model
{
      protected $table='iklan';
    protected $fillable =['judul_iklan','deskripsi_iklan','pemesan_iklan','link_iklan','foto_iklan','video','lokasi','tanggal_upload','tanggal_expired','pengupload','status'];
    public $timestaps = false;
}
