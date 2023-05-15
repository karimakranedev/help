<?php

namespace Database\Seeders;


use File;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RegionVilleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sql = File::get('database/data/RegionsVilles.sql');
        DB::unprepared($sql);
        \Log::info('SQL Import Done');

    }
}
