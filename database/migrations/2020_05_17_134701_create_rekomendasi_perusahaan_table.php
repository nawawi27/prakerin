<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRekomendasiPerusahaanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekomendasi_perusahaan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('peserta_id');
            $table->string('nama_perusahaan', 60);
            $table->string('pemilik_perusahaan', 60);
            $table->string('bidang_usaha', 60);
            $table->string('tlp_perusahaan', 15);
            $table->text('alamat');
            $table->string('latitude', 191)->nullable();
            $table->string('longitude', 191)->nullable();
            $table->string('status', 20);
            $table->integer('kuota');
            $table->timestamps();

            // Relasi
            $table->foreign('peserta_id')->references('id')->on('peserta')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rekomendasi_perusahaan');
    }
}
