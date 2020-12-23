<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class AgentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('agent')->insert([
            'name' => 'John Doe',

            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
