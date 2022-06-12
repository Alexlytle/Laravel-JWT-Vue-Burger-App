<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submit_bugers', function (Blueprint $table) {
            $table->id();

            $table->string('name');
            $table->string('city');
            $table->string('zip');
            $table->string('phone');
            $table->string('email');
            $table->json('burger_data');

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
        Schema::dropIfExists('submit_bugers');
    }
};
