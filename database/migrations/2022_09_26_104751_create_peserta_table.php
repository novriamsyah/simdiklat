<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesertaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peserta', function (Blueprint $table) {
            $table->string('nip', 30)->primary();
            $table->string('nama_lengkap');
            $table->string('email');
            $table->string('password');
            $table->enum('jk', ['L', 'P'])->nullable();
            $table->text('alamat')->nullable();
            $table->string('role')->default('psrt');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->string('golongan')->nullable();
            $table->string('nohp')->nullable();
            $table->string('jabatan')->nullable();
            $table->unsignedBigInteger('opd_id')->nullable();
            $table->foreign('opd_id')->references('id')->on('opd')->onDelete('cascade');
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
        Schema::dropIfExists('peserta');
    }
}
