<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->unsigned();
            $table->integer('project_id')->unsigned();
            $table->integer('creator_id')->unsigned();
            $table->integer('assigned_to_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->integer('priority_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->integer('estimation')->unsigned();
            $table->integer('spent_time')->unsigned();
            $table->boolean('is_done')->nullable();
            $table->timestamps();

            $table->foreign('parent_id')->references('id')->on('tasks')->onDelete('cascade');
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('restrict');
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('assigned_to_id')->references('id')->on('users')->onDelete('restrict');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('restrict');
            $table->foreign('type_id')->references('id')->on('types')->onDelete('restrict');
            $table->foreign('priority_id')->references('id')->on('priorities')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
