<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LandscapingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $landscapings = [
            [
                'title' => 'Детская площадка',
                'description' => '',
                'photo' => null
            ],
            [
                'title' => ' Спортивная площадка',
                'description' => '',
                'photo' => null
            ],
            [
                'title' => 'Места для работы',
                'description' => '',
                'photo' => null
            ],
            [
                'title' => 'Зона для фитнеса',
                'description' => '',
                'photo' => null
            ],
            [
                'title' => 'Двор без машины',
                'description' => '',
                'photo' => null
            ],
        ];

        DB::table('landscapings')->insert($landscapings);
    }
}
