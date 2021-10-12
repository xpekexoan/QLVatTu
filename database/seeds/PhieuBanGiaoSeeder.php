<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PhieuBanGiaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $str = File::get('database/seeds/data/phieubangiao.json');
        $data = json_decode($str, true);
        foreach ($data as $item) {
            if (array_key_exists('NgayBanGiao', $item)) {
                $item['NgayBanGiao'] = Carbon::createFromFormat('m/d/y', $item['NgayBanGiao'])->format('Y/m/d');
            }
            DB::table('PhieuBanGiao')->insert($item);
        }
    }
}
