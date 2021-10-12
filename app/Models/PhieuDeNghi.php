<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Facade\FormatDate;

class PhieuDeNghi extends Model
{
    protected $fillable = [
        'ID_NguoiDN', 'ID_NVCSVC', 'LoaiPhieu',
        'NgayLapPhieu', 'NgayDuKien', 'NgayHoanThanh',
        'TrangThai', 'GhiChu'
    ];
    protected $table = 'PhieuDenghi';
    protected $primaryKey = 'ID';
    public $incrementing = false;
    public $timestamps = false;

    const CREATED_AT = 'NgayLapPhieu';

    public function nguoiDeNghi()
    {
        return $this->belongsTo(NguoiDung::class, 'ID_NguoiDN', 'ID');
    }

    public function nguoiXetDuyet()
    {
        return $this->belongsTo(NguoiDung::class, 'ID_NVCSVC', 'ID');
    }

    public function chiTietMua()
    {
        return $this->hasMany(ChiTietMua::class, 'ID_Phieu', 'ID');
    }

    public function chiTietSua()
    {
        return $this->hasMany(ChiTietSua::class, 'ID_Phieu', 'ID');
    }

    public function danhSachBanGiao()
    {
        return $this->hasMany(PhieuBanGiao::class, 'ID_PhieuDN', 'ID');
    }

    public function NguoiTaoPhieu()
    {
        return $this->hasMany(NguoiDung::class, 'ID', 'ID_NguoiDN');
    }

    public function trangThai()
    {
        switch ($this->TrangThai) {
            case 1:
                if ($this->GhiChu) {
                    return 'Cần sửa đổi';
                }
                return 'Chờ duyệt';
                break;
            case 2:
                return 'Chờ bàn giao';
                break;
            case 3:
                return 'Hoàn thành';
                break;
        }
    }

    public function loaiPhieu()
    {
        switch ($this->LoaiPhieu) {
            case 1:
                return 'Phiếu mua';
                break;
            case 2:
                return 'Phiếu sửa';
                break;
        }
    }

    public function getNgayLapPhieuAttribute($date)
    {
        return FormatDate::formatDateTime($date);
    }
    public function getNgayDuKienAttribute($date)
    {
        if (!$date) {
            return null; 
        }
        return FormatDate::formatDate($date);
    }
    public function getNgayHoanThanhAttribute($date)
    {
        if (!$date) {
            return null;
        }
        return FormatDate::formatDateTime($date);
    }

    public function tongSoLuongDN()
    {
        return $this->chiTietMua->sum('SoLuong');
    }
 
    public function tongSoLuongBG()
    {
        $count = 0;
        foreach ($this->chiTietMua as $item) {
            $count += $item->soLuongDaBG();
        }
        return $count;
    }
}
