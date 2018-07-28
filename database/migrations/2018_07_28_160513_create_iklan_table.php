<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIklanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iklan', function (Blueprint $table) {
            $table->increments('id');
            $table->string('judul_iklan');
            $table->string('deskripsi_iklan');
            $table->string('pemesan_iklan');
            $table->string('link_iklan');
            $table->text('foto_iklan');
            $table->enum('lokasi', ['header', 'sidebar','footer'])->default('header');
            $table->date('tanggal_upload');
            $table->date('tanggal_expired');
            $table->string('pengupload');
            $table->enum('status', ['aktif', 'non aktif'])->default('aktif');
            $table->timestamps();
            });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
