<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('strip_cus_id')->nullable();
            $table->string('strip_charge_id')->nullable();
            $table->string('address_1');
            $table->string('address_2');
            $table->string('town');
            $table->string('county');
            $table->string('postcode');
            $table->string('country');
            $table->string('phone')->nullable();
            $table->string('pf_ref')->nullable();
            $table->text('gift-text')->nullable();
            $table->decimal('total', 10, 2);
            $table->integer('coupon_id')->unsigned()->nullable();
            $table->integer('status')->default(0);
            $table->timestamps();
        });

        Schema::table('orders', function($table) {
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
        Schema::dropIfExists('orders');
    }
}
