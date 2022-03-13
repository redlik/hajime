<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GendersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genders')->delete();

        DB::table('genders')->insert([
            ['name' => 'Female',
                'short' => 'Female',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'Male',
                'short' => 'Male',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'AFAB  Redfined/Non Binary – Assigned Female At Birth',
                'short' => 'AFAB',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')],
            ['name' => 'AMAB  Redfined/Non Binary – Assigned Male At Birth',
                'short' => 'AMAB',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')],
        ]);
    }
}
