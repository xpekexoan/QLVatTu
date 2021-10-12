<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class HanMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $str = File::get('database/seeds/data/hanmuc.json');
        $data = json_decode($str, true);
        foreach ($data as $item) {
            $item['NgayBatDau'] = \Carbon\Carbon::createFromFormat('m/d/y', $item['NgayBatDau'])->format('Y/m/d');
            DB::table('HanMuc')->insert($item);
        }
    }
}
