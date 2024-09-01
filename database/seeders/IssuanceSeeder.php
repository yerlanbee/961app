<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IssuanceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $issuances = [
            [
                'title' => 'I кв'
            ],
            [
                'title' => 'II кв'
            ],
            [
                'title' => 'III кв'
            ],
            [
                'title' => 'IV кв'
            ],
        ];

        DB::table('issuances')->insert($issuances);
    }
}
