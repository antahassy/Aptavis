<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tb_admin_group_2 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_admin_group_2')->insert([
        	'id_admin'		    => '1',
        	'id_group'		    => '1',
            'created_by'        => 'System',
        	'created_at'		=> date('Y-m-d H:i:s')
        ]);
    }
}
