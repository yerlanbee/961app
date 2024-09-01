<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class HouseClassSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            [
                'title' => 'Стандарт',
                'published' => true
            ],
            [
                'title' => 'Комфорт',
                'published' => true
            ],
            [
                'title' => 'Комфорт+',
                'published' => true
            ],
            [
                'title' => 'Бизнес',
                'published' => true
            ],
        ];

        DB::table('house_classes')->insert($classes);
    }
}
