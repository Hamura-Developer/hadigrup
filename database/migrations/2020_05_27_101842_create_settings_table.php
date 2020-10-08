<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id_config');
            $table->string('nama',255)->nullable();
            $table->string('slogan',255)->nullable();
            $table->text('deskripsi_situs')->nullable();
            $table->text('meta_deskripsi')->nullable();
            $table->text('meta_keyword')->nullable();
            $table->text('telepon')->nullable();
            $table->text('website')->nullable();
            $table->text('alamat')->nullable();
            $table->string('email_website')->unique()->nullable();
            $table->string('pemilik')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
            $table->boolean('maintenance')->default(false);
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('instagram')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
