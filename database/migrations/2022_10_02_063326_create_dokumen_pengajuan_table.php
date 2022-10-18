<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDokumenPengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dokumen_pengajuan', function (Blueprint $table) {
            $table->id();
            $table->string('dokumen');
            $table->string('nm_dokumen')->nullable();
            $table->enum('cek', ['0', '1', '2']);
            $table->string('catatan')->nullable();
            $table->unsignedBigInteger('id_pengajuan');
            $table->foreign('id_pengajuan')->references('id')->on('pengajuan_diklat')->onDelete('cascade');
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
        Schema::dropIfExists('dokumen_pengajuan');
    }
}
