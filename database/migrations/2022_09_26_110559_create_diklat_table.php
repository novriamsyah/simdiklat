<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiklatTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diklat', function (Blueprint $table) {
            $table->id();
            $table->string('nama_diklat');
            $table->integer('jp');
            $table->integer('angkatan');
            $table->year('tahun');
            $table->date('mulai_pendaftaran');
            $table->date('selesai_pendaftaran');
            $table->date('mulai_pelakasanaan');
            $table->date('selesai_pelakasanaan');
            $table->date('batas_upload');
            $table->unsignedBigInteger('id_jenis_diklat');
            $table->foreign('id_jenis_diklat')->references('id')->on('jenis_diklat')->onDelete('cascade');
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
        Schema::dropIfExists('diklat');
    }
}
