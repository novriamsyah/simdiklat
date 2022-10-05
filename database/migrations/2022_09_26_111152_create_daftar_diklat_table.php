<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDaftarDiklatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daftar_diklat', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_diklat');
            $table->foreign('id_diklat')->references('id')->on('diklat')->onDelete('cascade');
            $table->string('nip_peserta');
            $table->foreign('nip_peserta')->references('nip')->on('peserta')->onDelete('cascade');            
            $table->date('tanggal_daftar');
            $table->enum('status', ['0', '1', '2']);
            $table->string('catatan')->nullable();
            $table->string('sertifikat')->nullable();
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
        Schema::dropIfExists('daftar_diklat');
    }
}
