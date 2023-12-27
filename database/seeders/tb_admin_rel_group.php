<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tb_admin_rel_group extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_admin_rel_group')->insert([
            [
                'id_group' 			=> '1',
                'id_menu' 			=> '1',
                'akses' 			=> '1',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s')
            ],
            [
                'id_group' 			=> '1',
                'id_menu' 			=> '6',
                'akses' 			=> '1',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s')
            ],
            [
                'id_group' 			=> '2',
                'id_menu' 			=> '6',
                'akses' 			=> '1',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s')
            ],
        ]);
        for($i = 2; $i < 6; $i ++){
            for($x = 1; $x < 5; $x ++){
                DB::table('tb_admin_rel_group')->insert([
                    'id_group' 			=> '1',
                    'id_menu' 			=> $i,
                    'akses' 			=> $x,
                    'created_by'        => 'System',
                    'created_at'		=> date('Y-m-d H:i:s')
                ]);
            }
        }
    }
}
