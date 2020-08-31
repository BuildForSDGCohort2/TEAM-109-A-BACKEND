<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStorageFacilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('storage_facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('capacity')->nullable();
            $table->integer('community_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('address')->nullable();
            $table->enum("status",["ACTIVE","IDLE","NOT_SPECIFIED"])->default("NOT_SPECIFIED");
            $table->enum("availability",["AVAILABLE","UNAVAILABLE","NOT_SPECIFIED"])->default("NOT_SPECIFIED");
            $table->enum("storage_type",["PERISHABLE","NON_PERISHABLE", "BOTH","NOT_SPECIFIED"])->default("NOT_SPECIFIED");
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
        Schema::dropIfExists('storage_facilities');
    }
}
