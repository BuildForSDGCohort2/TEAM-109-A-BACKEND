<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmProducesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farm_produces', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->enum("produce_type",["PERISHABLE","NON_PERISHABLE","BOTH","NOT_SPECIFIED"])->default("NOT_SPECIFIED");
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
        Schema::dropIfExists('farm_produces');
    }
}
