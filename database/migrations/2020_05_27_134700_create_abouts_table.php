<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAboutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('abouts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('konten1')->nullable();
            $table->text('konten2')->nullable();
            $table->string('gambar')->nullable();
            $table->string('judul1')->nullable();
            $table->string('judul2')->nullable();
            $table->string('judul3')->nullable();
            $table->text('teks1')->nullable();
            $table->text('teks2')->nullable();
            $table->text('teks3')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('meta_deskripsi')->nullable();
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
        Schema::dropIfExists('abouts');
    }
}
