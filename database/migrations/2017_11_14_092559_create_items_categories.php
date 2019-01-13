<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items_categories', function (Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->integer('item_id')->unsigned();
            $table->integer('food_category_id')->unsigned();
        });

        Schema::table('items_categories', function($table) {
            $table->foreign('item_id')->references('id')->on('items')->onDelete('cascade');
            $table->foreign('food_category_id')->references('id')->on('food_categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items_categories');
    }
}
