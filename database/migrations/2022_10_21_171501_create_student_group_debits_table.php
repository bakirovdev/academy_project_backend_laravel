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
        Schema::create('student_group_debits', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->integer('student_id');
            $table->double('value');
            $table->double('bonus');
            $table->integer('month')->max(12);
            $table->year('year');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups')->restrictOnDelete();
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
        Schema::dropIfExists('student_group_debits');
    }
};
