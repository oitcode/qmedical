<?php

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\DB;

use Carbon\Carbon;

class MedicalTestTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('medical_test_type')->insert([
            'name' => 'Foreign Medical',
            'rate' => 4500,


            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
