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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('sheduleType_id');
            $table->string('scheduleTypes');
            $table->timestamps();

            
            $table->foreign('member_id')->references('id')->on('members')->onDelete('cascade');
            $table->foreign('sheduleType_id')->references('id')->on('schedule_types')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('schedules');
    }
};
