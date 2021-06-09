<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id')->unsigned();
            $table->foreignId('perusahaan_id')->unsigned();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('path', 191);
            $table->string('status', 30);
            $table->timestamps();

            // Relasi
            $table->foreign('peserta_id')->references('id')->on('peserta')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('perusahaan_id')->references('id')->on('perusahaan')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pengajuan');
    }
}
