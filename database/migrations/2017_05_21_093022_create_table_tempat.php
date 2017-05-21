<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableTempat extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('tempat', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('kategori_id')->unsigned();
            $table->string('nama_tempat');
            $table->string('alamat');
            $table->string('keterangan');
            $table->string('latitude');
            $table->string('longitude');
            $table->timestamps();

            $table->foreign('kategori_id')
                  ->references('id')->on('kategori')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
         Schema::drop('tempat');
    }
}
