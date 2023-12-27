<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
        	tb_admin::class,
        	tb_admin_group::class,
            tb_admin_group_2::class,
            tb_admin_rel_group::class,
            tb_admin_menu::class,
            tb_admin_setting::class,
        ]);
    }
}
