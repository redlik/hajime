<?php

namespace App\Console\Commands;

use App\Models\Club;
use Illuminate\Console\Command;

class RecalculateClubCompliance extends Command
{
    protected $signature = 'app:recalculate-club-compliance';

    protected $description = 'Recalculate the compliance indicator of every club from certificate expiry dates';

    public function handle()
    {
        $changed = 0;

        Club::with(['personnel', 'coach', 'volunteer'])->chunkById(100, function ($clubs) use (&$changed) {
            foreach ($clubs as $club) {
                $before = (bool) $club->compliant;
                if ($club->recalculateCompliance() !== $before) {
                    $changed++;
                }
            }
        });

        $this->info("Club compliance recalculated. Clubs changed: {$changed}");

        return Command::SUCCESS;
    }
}
