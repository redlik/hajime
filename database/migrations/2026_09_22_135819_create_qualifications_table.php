<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('qualifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('member_id');
            $table->string('type');
            $table->string('level');
            $table->date('date_attained')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
        });
    }

    public function down()
    {
        Schema::dropIfExists('qualifications');
    }
};
