<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';
            $table->increments('id');

            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');

            // required for Laravel 4.1.26
            $table->string('remember_token')->nullable();
            $table->timestamps();
        });

        DB::table('users')->insert(
            array(
                'name' => 'William Byrne',
                'password' => '$2y$10$MWUtgdRF2gjbhgsvTB7t.un9eMqdI/4DGL9wgrVZBDZjEnf8YQ1Ry',
                'email' => 'will_byrne56@hotmail.com',
                'created_at' => date('Y-m-d H:i:s')
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }

}