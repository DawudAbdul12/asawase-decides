<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->longText('bio')->nullable();
            $table->mediumText('pic')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
        // password - Concord@123
        DB::table('users')->insert([
            ['username' => 'Trapzium', 'email' => 'info@trapzium.com','password' => '$2y$10$f.iAXb8KjPlL.DbS.qLh2.tHqo1Nd0P6g3e7Z3ouEiDzVQSfVqJrO','type' => 'Super Administrator','status' => 'Active', 'created_at' =>  \Carbon\Carbon::now(), 'updated_at' =>  \Carbon\Carbon::now()],
           ]);
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
