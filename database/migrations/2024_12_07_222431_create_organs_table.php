<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrgansTable extends Migration
{
    public function up()
    {
        Schema::create('organs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status'); // available ou waiting
            $table->unsignedBigInteger('hospital_id');
            $table->timestamps();

            $table->foreign('hospital_id')->references('id')->on('hospitals')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('organs');
    }
}
