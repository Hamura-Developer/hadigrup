<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLandingpagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('landingpages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('judul')->nullable();
            $table->text('deskripsi')->nullable();
            $table->string('link')->nullable();
            $table->text('text_link')->nullable();
            $table->string('fonticon1')->nullable();
            $table->string('judulfitur1')->nullable();
            $table->text('konten1')->nullable();
            $table->string('link1')->nullable();
            $table->text('text_link1')->nullable();
            $table->string('fonticon2')->nullable();
            $table->string('judulfitur2')->nullable();
            $table->text('konten2')->nullable();
            $table->string('link2')->nullable();
            $table->text('text_link2')->nullable();
            $table->string('fonticon3')->nullable();
            $table->string('judulfitur3')->nullable();
            $table->text('konten3')->nullable();
            $table->string('link3')->nullable();
            $table->text('text_link3')->nullable();
            $table->string('gambar')->nullable();
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
        Schema::dropIfExists('landingpages');
    }
}
