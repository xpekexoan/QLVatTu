<?php

namespace App\Policies;

use App\Models\NguoiDung;
use App\Models\PhieuBanGiao;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhieuBanGiaoPolicy
{
    use HandlesAuthorization;

    public function detail(NguoiDung $nguoiDung, PhieuBanGiao $phieu)
    {
        return $nguoiDung->LoaiTK == 2 || $phieu->phieuDeNghi->ID_NguoiDN == $nguoiDung->ID;
    }

    public function edit(NguoiDung $nguoiDung, PhieuBanGiao $phieu)
    {
        return $phieu->phieuDeNghi->ID_NguoiDN == $nguoiDung->ID;
    }

    public function xacNhan(NguoiDung $nguoiDung, PhieuBanGiao $phieu)
    {
        return $phieu->phieuDeNghi->ID_NguoiDN == $nguoiDung->ID;
    }
}
