<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanDiklatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_diklat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_diklat');
            $table->integer('jp');
            $table->integer('angkatan');
            $table->string('tempat_diklat');
            $table->string('sertifikat')->nullable();
            $table->year('tahun');
            $table->enum('status', ['0', '1', '2']);
            $table->string('catatan')->nullable();
            $table->date('tanggal_daftar');
            $table->unsignedBigInteger('id_jenis_diklat');
            $table->foreign('id_jenis_diklat')->references('id')->on('jenis_diklat')->onDelete('cascade');
            $table->string('nip_peserta');
            $table->foreign('nip_peserta')->references('nip')->on('peserta')->onDelete('cascade');  
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
        Schema::dropIfExists('pengajuan_diklat');
    }
}
