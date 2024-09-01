<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name'          => 'admin',
                'description'   => 'Has full permission'
            ],
            [
                'name'          => 'guest',
                'description'   => 'Can only view content'
            ]
        ];

        DB::table('roles')->insert($roles);
    }
}
