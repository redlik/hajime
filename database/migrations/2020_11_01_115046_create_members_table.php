<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('number');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('county');
            $table->string('eircode')->nullable();
            $table->string('province');
            $table->date('dob');
            $table->string('gender');
            $table->string('phone')->nullable();
            $table->string('mobile')->nullable();
            $table->string('email')->nullable();
            $table->boolean('adaptive')->default(0);
            $table->string('special')->nullable();
            $table->boolean('active')->default(0);
            $table->unsignedBigInteger('club_id')->nullable();
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
        Schema::dropIfExists('members');
    }
}
