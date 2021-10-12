<?php

namespace App\Policies;

use App\Models\NguoiDung;
use App\Models\PhieuDeNghi;
use Illuminate\Auth\Access\HandlesAuthorization;

class PhieuDeNghiPolicy
{
    use HandlesAuthorization;

    public function hoanThanh(NguoiDung $nguoiDung, PhieuDeNghi $phieu)
    {
        return $phieu->ID_NguoiDN == $nguoiDung->ID;
    }

    public function detail(NguoiDung $nguoiDung, PhieuDeNghi $phieu)
    {
        return $phieu->ID_NguoiDN == $nguoiDung->ID;
    }

    public function edit(NguoiDung $nguoiDung, PhieuDeNghi $phieu)
    {
        return  $phieu->ID_NguoiDN == $nguoiDung->ID;
    }
}
