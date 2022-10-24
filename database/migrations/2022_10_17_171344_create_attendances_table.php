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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->integer('student_id');
            $table->integer('group_lesson_id');
            $table->boolean('attend')->default(true);
            $table->boolean('active')->default(true);
            $table->string('comment')->nullable();
            $table->boolean('payed')->default(false);
            $table->year('year');
            $table->date('date');
            $table->integer('month')->max(12);
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups')->restrictOnDelete();
            $table->foreign('student_id')->references('id')->on('students')->restrictOnDelete();
            $table->foreign('group_lesson_id')->references('id')->on('group_lessons')->restrictOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attendances');
    }
};
