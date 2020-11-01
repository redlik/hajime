<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonnelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personnels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('role');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->string('vetting_qualification');
            $table->date('vetting_expiry');
            $table->string('safeguarding_qualification');
            $table->date('safeguarding_date');
            $table->string('first_aid_qualification')->nullable();
            $table->date('first_aid_date')->nullable();
            $table->string('coaching_qualification')->nullable();
            $table->date('coaching_date')->nullable();
            $table->unsignedBigInteger('club_id');
            $table->timestamps();

            $table->foreign('club_id')->references('id')->on('clubs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personnels');
    }
}
