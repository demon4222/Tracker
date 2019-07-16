<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });
        DB::table('states')->insert([
            'name' => 'open'
        ]);
        DB::table('states')->insert([
            'name' => 'closed'
        ]);
        DB::table('states')->insert([
            'name' => 'need more info'
        ]);
        DB::table('states')->insert([
            'name' => 'cannot reproduce'
        ]);
        DB::table('states')->insert([
            'name' => 'fixed'
        ]);
        DB::table('states')->insert([
            'name' => 'done'
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
