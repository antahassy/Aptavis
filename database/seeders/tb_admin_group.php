<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tb_admin_group extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_admin_group')->insert([
            [
                'name' 			    => 'Administrator',
                'description'	    => 'Super Admin',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s')
            ],
            [
                'name' 			    => 'User',
                'description'	    => 'Pengguna',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s')
            ]
        ]);
    }
}
