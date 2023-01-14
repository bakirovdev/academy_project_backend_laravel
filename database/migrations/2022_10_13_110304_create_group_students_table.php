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
        Schema::create('group_students', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->integer('student_id');
            $table->float('bonus')->default(0);
            $table->boolean('active')->default(true);
            $table->date('start_date')->default(date('Y-m-d'));
            $table->date('end_date')->nullable();
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups')->nullOnDelete();
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
        Schema::dropIfExists('group_students');
    }
};
