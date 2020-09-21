<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('pondok_id');
            $table->unsignedInteger('user_id');
            $table->unsignedSmallInteger('type');
            $table->unsignedBigInteger('amount');
            $table->string('info',500);
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('pondok_id')->references('id')->on('pondok');
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
        Schema::dropIfExists('kas');
    }
}
