<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('todos', function (Blueprint $table) {
          $table->id();
          $table->unsignedBigInteger('user_id');
          $table->foreign('user_id')->references('id')->on('users');
          $table->date('date_initiated');
          $table->string('initiator');
          $table->string('email')->nullable();
          $table->string('initiator_site');
          $table->string('vat')->nullable();
          $table->string('currency')->nullable();
          $table->string('department')->nullable();
          $table->string('leadT')->nullable();
          $table->string('explanation')->nullable();
          $table->string('status')->default('pending');
          $table->string('slmD')->nullable();
          $table->string('slmN')->nullable();
          $table->string('slmM')->nullable();
          $table->string('slmC')->nullable();
          $table->string('hodD')->nullable();
          $table->string('hodN')->nullable();
          $table->string('hodM')->nullable();
          $table->string('hodC')->nullable();
          $table->string('opD')->nullable();
          $table->string('opN')->nullable();
          $table->string('opM')->nullable();
          $table->string('opC')->nullable();
          $table->string('mdD')->nullable();
          $table->string('mdN')->nullable();
          $table->string('mdC')->nullable();
          $table->string('type')->nullable();
          $table->boolean('printed')->default(false);
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
        Schema::dropIfExists('todos');
    }
}
