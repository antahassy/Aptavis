<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tb_admin_menu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_admin_menu')->insert([
            [
                'menu' 			    => 'Super Admin',
                'url' 			    => '#',
                'urutan' 			=> '1',
                'rel' 			    => '0',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s')
            ],
            [
                'menu' 			    => 'Daftar Admin',
                'url' 			    => 'list_admin',
                'urutan' 			=> '1',
                'rel' 			    => '1',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s')
            ],
            [
                'menu' 			    => 'Daftar Menu',
                'url' 			    => 'menu_admin',
                'urutan' 			=> '2',
                'rel' 			    => '1',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s')
            ],
            [
                'menu' 			    => 'Daftar Group',
                'url' 			    => 'group_admin',
                'urutan' 			=> '3',
                'rel' 			    => '1',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s')
            ],
            [
                'menu' 			    => 'Daftar Pengaturan',
                'url' 			    => 'setting_admin',
                'urutan' 			=> '4',
                'rel' 			    => '1',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s')
            ],
            [
                'menu' 			    => 'Dashboard',
                'url' 			    => 'admin_dashboard',
                'urutan' 			=> '2',
                'rel' 			    => '0',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s')
            ],
            [
                'menu' 			    => 'Klub',
                'url' 			    => 'admin_klub',
                'urutan' 			=> '3',
                'rel' 			    => '0',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s')
            ],
            [
                'menu' 			    => 'Skor',
                'url' 			    => 'admin_skor',
                'urutan' 			=> '4',
                'rel' 			    => '0',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s')
            ]
        ]);
    }
}
