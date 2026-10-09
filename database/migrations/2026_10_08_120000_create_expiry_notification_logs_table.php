<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Email copy is longer than the original 255 character option value.
        Schema::table('options', function (Blueprint $table) {
            $table->text('option_value')->change();
        });

        Schema::create('expiry_notification_logs', function (Blueprint $table) {
            $table->id();
            $table->string('person_type');            // personnel | coach | volunteer
            $table->unsignedBigInteger('person_id');
            $table->unsignedBigInteger('club_id')->nullable();
            $table->string('person_name')->nullable();
            $table->string('recipient')->nullable();
            $table->string('certificate');            // safeguarding | vetting | first_aid
            $table->date('expiry_date');
            $table->string('status');                 // sent | skipped_no_email | failed
            $table->text('error')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamps();

            // One notification per person per certificate per expiry event.
            $table->unique(['person_type', 'person_id', 'certificate', 'expiry_date'], 'expiry_notification_unique');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('expiry_notification_logs');

        Schema::table('options', function (Blueprint $table) {
            $table->string('option_value')->change();
        });
    }
};
