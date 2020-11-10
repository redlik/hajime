<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\ClubnoteSeeder;
use App\Models\Clubnote;

class ClubnoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Clubnote::factory()
            ->times(300)
            ->create();
    }
}
