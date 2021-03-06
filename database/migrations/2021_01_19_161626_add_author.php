<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAuthor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('club_documents', function (Blueprint $table) {
            $table->unsignedBigInteger('author')->after('club_id')->nullable();

            $table->foreign('author')->references('id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('club_documents', function (Blueprint $table) {
            //
        });
    }
}
