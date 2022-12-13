<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('custom_id');
            $table->string('name');
            $table->string('father_name');
            $table->string('mother_name');
            $table->date('date_of_birth');
            $table->tinyInteger('user_type')->default(5);
            $table->tinyInteger('registration_status')->default(5);
            $table->string('nationality');
            $table->string('nid_number');
            $table->string('bdris_number')->nullable();
            $table->tinyInteger('gender');
            $table->tinyInteger('religion');
            $table->string('phone_no')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
