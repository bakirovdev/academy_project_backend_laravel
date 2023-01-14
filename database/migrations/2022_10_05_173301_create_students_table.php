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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number', 25)->nullable();
            $table->enum('status', ['waiting', 'confirmed', 'canceled'])->default('waiting');
            $table->date('birthday');
            $table->enum('gender', ['male', 'female']);
            $table->integer('region_id');
            $table->foreign('region_id')->references('id')->on('regions')->nullONDelete();
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
        Schema::dropIfExists('students');
    }
};
