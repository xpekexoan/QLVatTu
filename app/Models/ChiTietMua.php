<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ChiTietMua extends Model
{
    protected $fillable = [
        'ID_Phieu', 'ID_VatTu', 'SoLuong', 'Gia'
    ];

    protected $table = 'ChiTietMua';
    public $timestamps = false;
    public function vatTu()
    {
        return $this->belongsTo(VatTu::class, 'ID_VatTu', 'ID');
    }

    public function phieu()
    {
        return $this->belongsTo(PhieuDeNghi::class, 'ID_Phieu', 'ID');
    }

    public function soLuongDangBG($id_phieuBG = null)
    {
        if ($id_phieuBG) {
            $query = DB::table('ChiTietBanGiao')->join('PhieuBanGiao', 'PhieuBanGiao.ID', '=', 'ChiTietBanGiao.ID_Phieu')
                ->where('ChiTietBanGiao.ID_VatTu', '=', $this->ID_VatTu)
                ->where('PhieuBanGiao.ID_PhieuDN', '=', $this->phieu->ID)
                ->where('PhieuBanGiao.ID', '=', $id_phieuBG)
                ->select('ChiTietBanGiao.SoLuong')
                ->first();
        } else {
            $query = DB::table('ChiTietBanGiao')->join('PhieuBanGiao', 'PhieuBanGiao.ID', '=', 'ChiTietBanGiao.ID_Phieu')
                ->where('ChiTietBanGiao.ID_VatTu', '=', $this->ID_VatTu)
                ->where('PhieuBanGiao.ID_PhieuDN', '=', $this->phieu->ID)
                ->whereNull('PhieuBanGiao.ID_NguoiXN')
                ->select('ChiTietBanGiao.SoLuong')
                ->first();
        }
        return !!$query ? $query->SoLuong : 0;
    }

    public function soLuongDaBG($id_phieuBG = null)
    {
        if ($id_phieuBG) {
            $query = DB::table('ChiTietBanGiao')->join('PhieuBanGiao', 'PhieuBanGiao.ID', '=', 'ChiTietBanGiao.ID_Phieu')
                ->where('ChiTietBanGiao.ID_VatTu', '=', $this->ID_VatTu)
                ->where('PhieuBanGiao.ID_PhieuDN', '=', $this->phieu->ID)
                ->whereNotNull('PhieuBanGiao.ID_NguoiXN')
                ->whereNotIn('ChiTietBanGiao.ID_Phieu', [$id_phieuBG]);
        } else {
            $query = DB::table('ChiTietBanGiao')->join('PhieuBanGiao', 'PhieuBanGiao.ID', '=', 'ChiTietBanGiao.ID_Phieu')
                ->where('ChiTietBanGiao.ID_VatTu', '=', $this->ID_VatTu)
                ->where('PhieuBanGiao.ID_PhieuDN', '=', $this->phieu->ID)
                ->whereNotNull('PhieuBanGiao.ID_NguoiXN');
        }
        return $query->sum('ChiTietBanGiao.SoLuong');
    }
}
