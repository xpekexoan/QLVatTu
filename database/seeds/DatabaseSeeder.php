<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call([
            VatTuSeeder::class,
            KhoaPBSeeder::class,
            HanMucSeeder::class,
            NguoiDungSeeder::class,
            PhieuDeNghiSeeder::class,
            ChiTietMuaSeeder::class,
            ChiTietSuaSeeder::class,
            PhieuBanGiaoSeeder::class,
            ChiTietBanGiaoSeeder::class,
        ]);
    }
}
