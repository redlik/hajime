<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->date('vetting_completion')->nullable();
            $table->date('vetting_expiry')->nullable();
            $table->date('safeguarding_completion')->nullable();
            $table->date('safeguarding_expiry')->nullable();
            $table->date('first_aid_completion')->nullable();
            $table->date('first_aid_expiry')->nullable();
            $table->text('compliance_comments')->nullable();
        });
    }

    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn([
                'vetting_completion',
                'vetting_expiry',
                'safeguarding_completion',
                'safeguarding_expiry',
                'first_aid_completion',
                'first_aid_expiry',
                'compliance_comments',
            ]);
        });
    }
};
