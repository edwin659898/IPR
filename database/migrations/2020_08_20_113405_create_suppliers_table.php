<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSuppliersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('file')->nullable();
            $table->string('level')->default('pending');
            $table->string('company')->nullable();
            $table->string('box')->nullable();
            $table->string('code')->nullable();
            $table->string('city')->nullable();
            $table->string('tel')->nullable();
            $table->string('web')->nullable();
            $table->string('mail')->nullable();
            $table->string('contact')->nullable();
            $table->string('nature')->nullable();
            $table->string('location')->nullable();
            $table->string('account')->nullable();
            $table->string('bank')->nullable();
            $table->string('branch')->nullable();
            $table->string('swift')->nullable();
            $table->string('Scode')->nullable();
            $table->string('number')->nullable();
            $table->string('till')->nullable();
            $table->string('bill')->nullable();
            $table->string('Cduration')->nullable();
            $table->string('Climit')->nullable();
            $table->string('intro')->nullable();
            $table->string('site')->nullable();
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
        Schema::dropIfExists('suppliers');
    }
}
