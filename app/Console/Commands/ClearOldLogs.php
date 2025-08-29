<?php

namespace App\Console\Commands;

use Illuminate\Support\Facades\Cache;
use Illuminate\Console\Command;
use Spatie\Activitylog\Models\Activity;

class ClearOldLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:clear-old-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $days = Cache::get('retentionLogDays');
        $deletedCount = Activity::where('created_at', '<', now()->subDays($days))->delete();
        $this->info("Deleted {$deletedCount} activity log(s) older than {$days} days.");
    }
}
