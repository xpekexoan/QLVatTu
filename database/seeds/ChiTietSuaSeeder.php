<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ChiTietSuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $str = File::get('database/seeds/data/chitietsua.json');
        $data = json_decode($str, true);
        foreach ($data as $item) {
            DB::table('ChiTietSua')->insert($item);
        }
    }
}
