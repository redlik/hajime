<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ClubDocument;

class ClubDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClubDocument::factory()
            ->times(300)
            ->create();
    }
}
