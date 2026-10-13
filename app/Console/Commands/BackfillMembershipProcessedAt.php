<?php

namespace App\Console\Commands;

use App\Models\Membership;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BackfillMembershipProcessedAt extends Command
{
    protected $signature = 'memberships:backfill-processed-at {--dry-run : Show how many rows would change without saving}';

    protected $description = 'Set a blank memberships.processed_at to the record\'s created_at (existing values are never changed)';

    public function handle()
    {
        $query = Membership::whereNull('processed_at')->whereNotNull('created_at');
        $count = $query->count();

        if ($this->option('dry-run')) {
            $this->info("{$count} membership(s) would be updated.");

            return self::SUCCESS;
        }

        $updated = $query->update(['processed_at' => DB::raw('created_at')]);
        $this->info("Updated {$updated} membership(s).");

        return self::SUCCESS;
    }
}
