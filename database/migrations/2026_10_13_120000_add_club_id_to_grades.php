<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Nullable: existing gradings and Competition-only notes have no club.
        Schema::table('grades', function (Blueprint $table) {
            $table->foreignId('club_id')->nullable()->constrained('clubs')->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('grades', function (Blueprint $table) {
            $table->dropConstrainedForeignId('club_id');
        });
    }
};
