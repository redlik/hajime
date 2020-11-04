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
            $table->date('vetting_completion');
            $table->date('vetting_expiry');
            $table->date('safeguarding_completion');
            $table->date('safeguarding_expiry');
            $table->date('first_aid_completion')->nullable();
            $table->date('first_aid_expiry')->nullable();
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
