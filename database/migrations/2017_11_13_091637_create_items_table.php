<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->integer('stock');
            $table->integer('sort');
            $table->string('title');
            $table->text('text');
            $table->decimal('price', 10, 2);
            $table->integer('protein');
            $table->integer('carbs');
            $table->integer('fat');
            $table->integer('fibre');
            $table->integer('cals');
            $table->integer('sat_fat')->nullable();
            $table->integer('tran_fat')->nullable();
            $table->integer('cholesterol')->nullable();
            $table->integer('salt')->nullable();
            $table->integer('sugar')->nullable();
            $table->integer('polyol')->nullable();
            $table->string('serving');
            $table->boolean('subscription')->default(1);
            $table->boolean('is_order')->default(1);
            $table->boolean('is_active')->default(1);
            $table->boolean('is_gift')->default(0);
            $table->boolean('is_featured')->default(0);
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
        Schema::dropIfExists('items');
    }
}
