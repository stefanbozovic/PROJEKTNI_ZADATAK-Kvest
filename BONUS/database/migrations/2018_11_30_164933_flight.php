<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Flight extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('flights', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("aircraft");
            $table->integer("airport");
            $table->integer("total_seats");
            $table->string("from",32);
            $table->string("to",32);
            $table->dateTime("departure");
            $table->dateTime("arrival");

        });
        Schema::create('seats',function(Blueprint $table){
            $table->increments('id');
            $table->integer('flight_id');
            $table->integer('class_code'); 
            $table->integer('number'); 
            $table->double('price');
            
        });
        Schema::create('clients',function(Blueprint $table){
            $table->increments('id');
            $table->integer('seat_id');
            $table->string('first_name',32);
            $table->string('last_name',32);
            $table->string('phone',32);
            $table->string('booking_code',32);
            $table->string('email',32)->nullable();
            $table->string('passport',32)->nullable();
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
        Schema::dropIfExists('flight');
        Schema::dropIfExists('aircraft');
        Schema::dropIfExists('airport');
        Schema::dropIfExists('travel_class');
        Schema::dropIfExists('aircraft_seat');
        Schema::dropIfExists('booking');
        Schema::dropIfExists('client');
    }
}
