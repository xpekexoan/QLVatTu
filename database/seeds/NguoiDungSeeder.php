<?php

use App\Models\NguoiDung;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class NguoiDungSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $data = [
        //     'id' => 'ND00000001',
        //     'TaiKhoan' => 'admin',
        //     'MatKhau' => Hash::make('123123'),
        //     'LoaiTK' => NguoiDung::ADMIN
        // ];
        $str = File::get('database/seeds/data/nguoidung.json');
        $data = json_decode($str, true);
        foreach ($data as $item) {
            $item['MatKhau'] = Hash::make($item['MatKhau']);
            DB::table('NguoiDung')->insert($item);
        }
    }
}
