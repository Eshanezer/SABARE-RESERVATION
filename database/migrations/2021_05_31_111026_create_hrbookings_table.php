<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrbookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hrbookings', function (Blueprint $table) {
            $table->increments('BookingId');
            $table->date('CheckInDate');
			$table->date('CheckOutDate');
			$table->integer('NoOfAdults');
			$table->integer('NoOfChildren');
            $table->string('Description');
            $table->boolean('VCApproval')->default(0);
			$table->date('Date');
            $table->integer('GuestId')->unsigned();
			$table->foreign('GuestId')->references('id')->on('users'); 
            $table->integer('HolodayResortId')->unsigned();
			$table->foreign('HolodayResortId')->references('HolodayResortId')->on('holidayresorts'); 
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
        Schema::dropIfExists('hrbookings');
    }
}
