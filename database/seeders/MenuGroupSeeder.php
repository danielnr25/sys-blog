<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menu_groups')->insert([
            'name' => 'Administración',
            'icon' => 'fas fa-users-cogs',
            'order' => 1,
        ]);
        DB::table('menu_groups')->insert([
            'name' => 'Usuarios',
            'icon' => 'fas fa-users',
            'order' => 2,
        ]);
    }
}
