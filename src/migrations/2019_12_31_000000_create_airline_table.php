<?php
/**
 * Created by PhpStorm.
 * User: dyangalih
 * Date: 2019-02-14
 * Time: 02:06
 */

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirlineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('airlines', function (Blueprint $table) {
            $table->increments('id')
                ->comment('table to store airports data');
            $table->string('name', 100)
                ->nullable(false)
                ->comment('Airline Name');
            $table->string('alias', 10)
                ->nullable(true)
                ->comment('Airline Alias');
            $table->string('iata_code', 10)
                ->nullable(true)
                ->index()
                ->comment('iata code');
            $table->string('icao_code', 10)
                ->index()
                ->nullable(true)
                ->comment('Call Sign');
            $table->string('call_sign', 50)
                ->nullable(true)
                ->comment('call sign');
            $table->unsignedInteger('country_id')
                ->nullable(false)
                ->comment('relation to country package');
            $table->enum('active', ['Y', 'N']);
            $table->unsignedBigInteger('user_id')
                ->nullable(false)
                ->comment('relation to laravel user package');
            $table->timestamps();

            /**
             * relation
             */

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
            $table->foreign('country_id')
                ->references('id')
                ->on('countries');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('airports');
    }
}