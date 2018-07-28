<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    protected $table='berita';
    protected $fillable =['judul_berita','isi_berita','link_berita','tanggal_upload','kategori','pengupload','status'];
    public $timestaps = false;
}
