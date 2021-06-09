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
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('grup_id');
            $table->foreignId('perusahaan_id')->nullable();
            $table->foreignId('pembimbing_id')->nullable();
            $table->string('nis', 15);
            $table->string('nama_lengkap', 60);
            $table->string('ttl', 60)->nullable();
            $table->enum('jk',['L','P']);
            $table->string('tlp_peserta', 20)->nullable();
            $table->string('tlp_orangtua', 20)->nullable();
            $table->text('catatan_kesehatan')->nullable();
            $table->text('alamat')->nullable();
            $table->integer('status');
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->integer('nilai_jurnal')->nullable();
            $table->integer('nilai_presentasi')->nullable();
            $table->timestamps();

            // Relasi
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('grup_id')->references('id')->on('grup')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('perusahaan_id')->references('id')->on('perusahaan')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign('pembimbing_id')->references('id')->on('pembimbing')->onUpdate('CASCADE')->onDelete('CASCADE');
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
