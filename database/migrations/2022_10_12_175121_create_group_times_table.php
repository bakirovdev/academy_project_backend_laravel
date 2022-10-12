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
        Schema::create('group_times', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->integer('time_id');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups')->nullOnDelete();
            $table->foreign('time_id')->references('id')->on('times')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('group_times');
    }
};
