<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class tb_admin_setting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tb_admin_setting')->insert([
            [
                'meta_data'			=> 'url',
                'value' 			=> 'Nama Domain',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s'),
            ],
            [
                'meta_data'			=> 'title',
                'value' 			=> 'Nama Situs - Judul',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s'),
            ],
            [
                'meta_data'			=> 'description',
                'value' 			=> 'Nama Situs - Deskripsi',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s'),
            ],
            [
                'meta_data'			=> 'icon',
                'value' 			=> 'icon.png',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s'),
            ],
            [
                'meta_data'			=> 'icon_text',
                'value' 			=> 'icon_text.png',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s'),
            ],
            [
                'meta_data'			=> 'footer',
                'value' 			=> 'Nama Situs',
                'created_by'        => 'System',
                'created_at'		=> date('Y-m-d H:i:s'),
            ]
        ]);
    }
}
