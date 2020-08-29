<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFarmsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('farms', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('location')->nullable();
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
            $table->integer('country_id')->nullable();
            $table->integer('state_id')->nullable();
            $table->integer('lga_id')->nullable();
            $table->integer('community_id')->nullable();
            $table->integer('user_id')->nullable();
            $table->string('address')->nullable();
            $table->enum("farm_produce",["PERISHABLE","NON_PERISHABLE","BOTH","NOT_SPECIFIED"])->default("NOT_SPECIFIED");
            $table->timestamps();
        });

        // $table->enum("corporate_office_level",["head_office","branch_office","not_specified"])->default("not_specified");
        // $table->longText('payload')->nullable();
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('farms');
    }
}
