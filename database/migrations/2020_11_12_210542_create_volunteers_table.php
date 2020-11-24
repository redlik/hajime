<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVolunteersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('volunteers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->date('vetting_completion')->nullable();
            $table->date('vetting_expiry')->nullable();
            $table->date('safeguarding_completion')->nullable();
            $table->date('safeguarding_expiry')->nullable();
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
        Schema::dropIfExists('volunteer');
    }
}
