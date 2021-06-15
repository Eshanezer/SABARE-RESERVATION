<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAgridbookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agridbookings', function (Blueprint $table) {
            $table->increments('BookingId');
            $table->date('CheckInDate');
            $table->time('StartTime', $precision = 0);
            $table->time('EndTime', $precision = 0);
			$table->integer('NoOfGuest');
            $table->string('Description');
            $table->boolean('VCApproval')->default(0);
			$table->date('Date');
            $table->unsignedBigInteger('GuestId');
			$table->foreign('GuestId')->references('id')->on('users'); 
            $table->integer('AgriFarmDiningId')->unsigned();
			$table->foreign('AgriFarmDiningId')->references('AgriFarmDiningId')->on('agrifarmdinings'); 
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
        Schema::dropIfExists('agridbookings');
    }
}
