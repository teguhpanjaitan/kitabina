<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserPondokTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user_pondok')->insert([
            'user_id' => '2',
            'pondok_id' => '1',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        DB::table('user_pondok')->insert([
            'user_id' => '2',
            'pondok_id' => '2',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
    }
}
