<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Nullable: memberships processed before this column existed are left blank (not backfilled).
        Schema::table('memberships', function (Blueprint $table) {
            $table->timestamp('processed_at')->nullable();
        });
    }

    public function down()
    {
        Schema::table('memberships', function (Blueprint $table) {
            $table->dropColumn('processed_at');
        });
    }
};
