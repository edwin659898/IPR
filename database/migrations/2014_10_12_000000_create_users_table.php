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
          $table->id();
          $table->string('name');
          $table->string('email')->unique();
          $table->string('supervisor');
          $table->string('secondSup')->nullable();
          $table->timestamp('email_verified_at')->nullable();
          $table->boolean('slm')->default(false);
          $table->boolean('hod')->default(false);
          $table->boolean('op')->default(false);
          $table->boolean('md')->default(false);
          $table->boolean('admin')->default(false);
          $table->string('site');
          $table->string('department')->nullable();
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
}
