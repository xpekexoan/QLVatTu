<?php

namespace App\Providers;

use App\Repositories\NguoiDung\NguoiDungInterface;
use App\Repositories\NguoiDung\NguoiDungRepository;
use App\Repositories\PhieuBanGiao\PhieuBanGiaoInterface;
use App\Repositories\PhieuBanGiao\PhieuBanGiaoRepository;
use App\Repositories\PhieuDeNghi\PhieuDeNghiInterface;
use App\Repositories\PhieuDeNghi\PhieuDeNghiRepository;
use App\Repositories\VatTu\VatTuInterface;
use App\Repositories\VatTu\VatTuRepository;
use App\Repositories\HanMuc\HanMucInterface;
use App\Repositories\HanMuc\HanMucRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PhieuDeNghiInterface::class, PhieuDeNghiRepository::class);
        $this->app->bind(PhieuBanGiaoInterface::class, PhieuBanGiaoRepository::class);
        $this->app->bind(VatTuInterface::class, VatTuRepository::class);
        $this->app->bind(NguoiDungInterface::class, NguoiDungRepository::class);
        $this->app->bind(HanMucInterface::class, HanMucRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
    }
}
