<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rating', function (Blueprint $table) {
            $table->id();
            $table->foreignId('perusahaan_id');
            $table->foreignId('peserta_id');
            $table->integer('rating');
            $table->text('ulasan');
            $table->timestamps();

            // Relasi
            $table->foreign('perusahaan_id')->references('id')->on('perusahaan')->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('rating');
    }
}
