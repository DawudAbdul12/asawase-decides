<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembershipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memberships', function (Blueprint $table) {
            $table->uuid('id')->unique();
            $table->id("membership_id")->startingValue(2400000000);
            $table->string('fname');
            $table->string('sname')->nullable();
            $table->string('lname');
            $table->enum('gender', ['Female', 'Male', 'Others'])->nullable();
            $table->mediumText('address')->nullable();
            $table->mediumText('location')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('dob')->nullable();
            $table->string('occupation')->nullable();
            $table->string('education')->nullable();
            $table->string('profile_pic')->nullable();
            $table->enum('status', ['approved', 'pending', 'suspension', 'dead','others'])->nullable();
            $table->mediumText('note')->nullable();
            $table->uuid('branch_id')->foreign('branch_id')->references('id')->on('branches')->onDelete('cascade');
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
        Schema::dropIfExists('memberships');
    }
}
