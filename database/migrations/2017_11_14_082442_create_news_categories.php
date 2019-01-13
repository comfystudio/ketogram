<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewsCategories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news_categories', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->integer('news_id')->unsigned();
            $table->integer('category_id')->unsigned();
        });

        Schema::table('news_categories', function($table) {
            $table->foreign('news_id')->references('id')->on('news')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('news_categories');
    }
}
