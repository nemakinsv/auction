<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLotsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('start_price');
            $table->string('src');
            $table->integer('auction_price')->nullable();
            $table->Integer('flag_run_auction')->nullable();
            $table->dateTime('last_refresh')->nullable();
            $table->string('last_offer_user')->nullable();
            $table->dateTime('last_offer')->nullable();
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
        Schema::dropIfExists('lots');
    }
}
