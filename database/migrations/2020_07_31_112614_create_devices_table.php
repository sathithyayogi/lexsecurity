<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDevicesTable extends Migration
{
    /**
     * Run the migrations.
     *device name, device id, mobile number, no of alarm raised, no of alarm active, alarm one time, alarm two time
     * @return void
     * movement status 0 red stop, 1 yellow, 2 green
     * connection status 0 not connected & 1 connected
     */
    public function up()
    {
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('deviceName');
            $table->string('deviceID');
            $table->integer('movementStatus')->nullable();
            $table->integer('connectionStatus')->nullable();
            $table->string('mobileNumber');
            $table->integer('initialized')->nullable();
            $table->integer('alarmRaisedNo')->nullable();
            $table->integer('alarmActiveNo')->nullable();
            $table->time('connectionTime')->nullable();
            $table->timestamp('alarmOneTime')->nullable();
            $table->time('alarmonetotTime')->nullable();
            $table->time('alarmtwototTime')->nullable();
            $table->timestamp('alarmTwoTime')->nullable();
            $table->integer('alarmOneRunStatus')->nullable();
            $table->integer('alarmTwoRunStatus')->nullable();
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
        Schema::dropIfExists('devices');
        Schema::dropIfExists('failed_jobs');
        Schema::dropIfExists('migrations');
        Schema::dropIfExists('password_resets');
        Schema::dropIfExists('users');
    }
}
