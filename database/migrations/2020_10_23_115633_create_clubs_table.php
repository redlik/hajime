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
            $table->string("address2");
            $table->string("town");
            $table->string("county");
            $table->string("eircode");
            $table->string("province");
            $table->string("type");
            $table->integer("phone");
            $table->string("email");
            $table->string("website");
            $table->string("facebook");
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
