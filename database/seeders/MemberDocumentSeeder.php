<?php

namespace Database\Seeders;

use App\Models\MemberDocument;
use Illuminate\Database\Seeder;

class MemberDocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MemberDocument::factory()
            ->times(300)
            ->create();
    }
}
