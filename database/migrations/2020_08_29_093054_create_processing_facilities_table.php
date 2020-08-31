<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessingFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('processing_facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('user_id')->nullable();
            $table->integer('machine_count')->nullable();
            $table->integer('manpower_count')->nullable();
            $table->integer('community_id')->nullable();
            $table->enum("availability",["AVAILABLE","UNAVAILABLE","NOT_SPECIFIED"])->default("NOT_SPECIFIED");
            $table->enum("status",["ACTIVE","IDLE","NOT_SPECIFIED"])->default("NOT_SPECIFIED");
            $table->enum("processing_type",["MANUAL","MECHANIZED","BOTH","NOT_SPECIFIED"])->default("NOT_SPECIFIED");
            $table->string('address')->nullable();
            $table->longText('location')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('lga_id')->nullable();
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
        Schema::dropIfExists('processing_facilities');
    }
}
