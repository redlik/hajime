<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClubsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clubs', function (Blueprint $table) {
            // TODO add all fields to the clubs table
            $table->id();
            $table->string('name')->unique();
            $table->string("address1");
            $table->string("address2")->nullable();
            $table->string("city");
            $table->string("county");
            $table->string("eircode")->nullable();
            $table->string("province");
            $table->string("type");
            $table->string("phone")->nullable();
            $table->string("email")->nullable();
            $table->string("website")->nullable();
            $table->string("facebook")->nullable();
            $table->boolean('compliant')->default(0);
            $table->boolean('voting_rights')->default(0);

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
        Schema::dropIfExists('clubs');
    }
}
