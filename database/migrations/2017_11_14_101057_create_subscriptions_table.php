<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('strip_cus_id')->nullable();
            $table->string('strip_sub_id')->nullable();
            $table->date('last_payment');
            $table->date('active_until');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('town');
            $table->string('county');
            $table->string('phone')->nullable();
            $table->string('postcode');
            $table->timestamps();
        });

        Schema::table('subscriptions', function($table) {
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
