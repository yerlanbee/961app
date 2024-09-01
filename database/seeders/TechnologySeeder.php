<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TechnologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologies = [
            [
                'title'         => 'Единый ключ доступа',
                'description'   => '',
                'photo'         => null
            ],
            [
                'title'         => 'Видео домофон',
                'description'   => '',
                'photo'         => null
            ],
            [
                'title'         => 'Лифты',
                'description'   => '',
                'photo'         => null
            ],
            [
                'title'         => 'Система видеонаблюдения',
                'description'   => '',
                'photo'         => null
            ],
            [
                'title'         => 'Доступ к сети WI-FI',
                'description'   => '',
                'photo'         => null
            ],
        ];

        DB::table('technologies')->insert($technologies);
    }
}
