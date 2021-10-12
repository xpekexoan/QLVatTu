<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PhieuDeNghiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $str = File::get('database/seeds/data/phieudenghi.json');
        $data = json_decode($str, true);
        foreach ($data as $item) {
            $item['NgayLapPhieu'] = Carbon::createFromFormat('m/d/y', $item['NgayLapPhieu'])->format('Y/m/d');
            if (array_key_exists('NgayDuKien', $item)) {
                $item['NgayDuKien'] = Carbon::createFromFormat('m/d/y', $item['NgayDuKien'])->format('Y/m/d');
            }
            if (array_key_exists('NgayHoanThanh', $item)) {
                $item['NgayHoanThanh'] = Carbon::createFromFormat('m/d/y', $item['NgayHoanThanh'])->format('Y/m/d');
            }
            DB::table('PhieuDeNghi')->insert($item);
        }
    }
}
