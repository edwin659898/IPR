<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStepsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('steps', function (Blueprint $table) {
              $table->id();
              $table->unsignedBigInteger('todo_id');
              $table->foreign('todo_id')->references('id')->on('todos');
              $table->string('step')->nullable();
              $table->string('description')->nullable();
              $table->string('uom')->nullable();
              $table->string('quantityR')->nullable();
              $table->string('unitP')->nullable();
              $table->string('totalP')->nullable();
              $table->string('budget')->nullable();
              $table->string('supplier')->nullable();
              $table->string('decision')->default('accept');
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
        Schema::dropIfExists('steps');
    }
}
