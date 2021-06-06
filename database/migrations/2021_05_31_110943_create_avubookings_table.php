<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAvubookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('avubookings', function (Blueprint $table) {
            $table->increments('BookingId');
			$table->string('EventName');
            $table->date('CheckInDate');
            $table->time('StartTime', $precision = 0);
            $table->time('EndTime', $precision = 0);
            $table->string('Description');
			$table->date('Date');
			$table->integer('RecommendedBy')->unsigned();
			$table->foreign('RecommendedBy')->references('UserId')->on('administrators');
            $table->unsignedBigInteger('GuestId');
			$table->foreign('GuestId')->references('id')->on('users'); 
            $table->integer('AVUId')->unsigned();
			$table->foreign('AVUId')->references('AVUId')->on('audiovisualunits'); 
			$table->integer('UserId')->unsigned();
			$table->foreign('UserId')->references('UserId')->on('administrators'); 
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
        Schema::dropIfExists('avubookings');
    }
}
