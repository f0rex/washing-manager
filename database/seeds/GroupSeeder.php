<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('groups')->insert([
            'name' => 'Auto',
            'mon' => TRUE,
            'tue' => TRUE,
            'wed' => TRUE,
            'thu' => TRUE,
            'fri' => TRUE,
            'sat' => FALSE,
            'sun' => FALSE,
            'internal' => 4,
            'external' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('groups')->insert([
            'name' => 'Furgoni',
            'mon' => TRUE,
            'tue' => TRUE,
            'wed' => TRUE,
            'thu' => TRUE,
            'fri' => TRUE,
            'sat' => FALSE,
            'sun' => FALSE,
            'internal' => 4,
            'external' => 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        DB::table('groups')->insert([
            'name' => 'Test',
            'mon' => TRUE,
            'tue' => TRUE,
            'wed' => TRUE,
            'thu' => FALSE,
            'fri' => FALSE,
            'sat' => FALSE,
            'sun' => FALSE,
            'internal' => 4,
            'external' => 2,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
