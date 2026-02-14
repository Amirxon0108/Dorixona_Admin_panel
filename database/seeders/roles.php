<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class roles extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
           [ 'name' => 'Admin',
            'role' => 'Admin',
            'created_at' => now(),
            'updated_at' => now(), ],
             [ 'name' => 'Manager',
            'role' => 'Manager',
            'created_at' => now(),
            'updated_at' => now(), ],
             [ 'name' => 'User',
            'role' => 'User',
            'created_at' => now(),
            'updated_at' => now(), ],
             [ 'name' => 'Visitor',
            'role' => 'Visitor',
            'created_at' => now(),
            'updated_at' => now(), ],

        ]);
    }
}
