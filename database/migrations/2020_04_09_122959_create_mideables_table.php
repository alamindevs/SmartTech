<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMideablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mideables', function (Blueprint $table) {
            $table->id();
            $table->foreignId('midea_id')->constrained()->onDelete('cascade');;
            $table->integer('mideable_id');
            $table->string('mideable_type');
            $table->timestamps();
            // $table->foreign('midea_id')->references('id')->on('mideas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mideables');
    }
}
