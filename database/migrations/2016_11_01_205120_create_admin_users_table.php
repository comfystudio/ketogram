<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admin_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('username');
            $table->string('password');
            $table->string('email')->unique();
            $table->integer('salt');
            $table->string('display_name');
            $table->timestamps();
        });

        DB::table('admin_users')->insert(
            array(
                'username' => 'william',
                'password' => '987acdd57500a6ab3a52271a017556d684f3d5e178cd2988800216f621af5557',
                'email' => 'will_byrne56@hotmail.com',
                'salt' => 1484762714,
                'display_name' => 'william',
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
        Schema::dropIfExists('admin_users');
    }
}
