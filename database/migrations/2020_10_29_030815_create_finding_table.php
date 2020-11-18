<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFindingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finding', function (Blueprint $table) {
            $table->id();
            $table->longText('title');
            $table->longtext('deliverable');
            $table->string('deli_data');
            $table->integer('area_id');
            $table->integer('prog_id');

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
        Schema::dropIfExists('finding');
    }
}
