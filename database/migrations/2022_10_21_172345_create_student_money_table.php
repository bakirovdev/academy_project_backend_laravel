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
        Schema::create('student_money', function (Blueprint $table) {
            $table->id();
            $table->integer('student_id');
            $table->double('value');
            $table->boolean('active')->default(true);
            $table->date('date');
            $table->timestamps();

            $table->foreign('student_id')->references('id')->on('students')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_money');
    }
};
