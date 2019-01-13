<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('referrer_id')->unsigned()->nullable();
            $table->string('user_email')->nullable();
            $table->date('valid_from');
            $table->date('valid_to');
            $table->integer('count');
            $table->integer('percentage');
            $table->integer('number_used')->default(0);
            $table->string('code')->unique();

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
        Schema::dropIfExists('coupons');
    }
}
