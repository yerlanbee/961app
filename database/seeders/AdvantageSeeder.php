<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdvantageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $advantages = [
            [
                'title'       => 'Выразительная архитектура',
                'description' => null,
                'photo' => null
            ],
            [
                'title'       => 'Закрыйтый благоустроенный двор',
                'description' => null,
                'photo' => null
            ],
            [
                'title'       => 'Подземный паркинг',
                'description' => null,
                'photo' => null
            ],
            [
                'title'       => 'Дизайнерскйи подход лобби',
                'description' => null,
                'photo' => null
            ],
            [
                'title'       => 'Собственная инфраструктура',
                'description' => null,
                'photo' => null
            ],
        ];

        DB::table('advantages')->insert($advantages);
    }
}
