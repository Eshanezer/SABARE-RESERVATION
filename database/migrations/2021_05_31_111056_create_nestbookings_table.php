<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNestbookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nestbookings', function (Blueprint $table) {
            
            $table->increments('BookingId');
            $table->string('BookingType');
            $table->date('CheckInDate');
			$table->date('CheckOutDate');
			$table->integer('NoOfAdults');
			$table->integer('NoOfChildren');
            $table->integer('NoOfUnits');
            $table->string('Description');
            $table->string('Status');
            $table->unsignedBigInteger('Recommendation_From')->nullable()->unsigned();
            $table->foreign('Recommendation_From')->references('id')->on('users'); 
            $table->boolean('VCApproval')->default(0);
            $table->boolean('IS_Vc_Approved')->default(0);
            $table->boolean('IS_Recommended')->default(0);
            $table->unsignedBigInteger('GuestName');
            $table->unsignedBigInteger('GuestId');
			$table->foreign('GuestId')->references('id')->on('users'); 
            $table->integer('NestId')->unsigned();
			$table->foreign('NestId')->references('NestId')->on('nests'); 
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
        Schema::dropIfExists('nestbookings');
    }
}
