<?php

namespace Database\Seeders;

use App\Models\Member;
use Illuminate\Database\Seeder;
use App\Models\Membernote;

class MembernoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Membernote::factory()
            ->times(900)
            ->create();
    }
}
