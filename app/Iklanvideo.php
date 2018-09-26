<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iklanvideo extends Model
{
      protected $table='iklan_video';
    protected $fillable =['judul_video','video','status'];
    public $timestaps = false;
}
