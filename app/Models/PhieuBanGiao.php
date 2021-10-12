<?php

namespace App\Models;

use App\Helpers\Facade\FormatDate;
use Illuminate\Database\Eloquent\Model;

class PhieuBanGiao extends Model
{
    protected $fillable = [
        'ID_PhieuDN', 'ID_NVCSVC', 'ID_NguoiXN', 'LyDo', 'NgayBanGiao'
    ];

    protected $table = 'PhieuBanGiao';

    protected $primaryKey = 'ID';
    public $incrementing = false;

    const UPDATED_AT = 'NgayBanGiao';

    public function chiTietBanGiao()
    {
        return $this->hasMany(ChiTietBanGiao::class, 'ID_Phieu', 'ID');
    }

    public function phieuDeNghi()
    {
        return $this->belongsTo(PhieuDeNghi::class, 'ID_PhieuDN', 'ID');
    }

    public function nguoiLapPhieu()
    {
        return $this->belongsTo(NguoiDung::class, 'ID_NVCSVC', 'ID');
    }

    public function nguoiXacNhan()
    {
        return $this->belongsTo(NguoiDung::class, 'ID_NguoiXN', 'ID');
    }

    public function trangThai()
    {
        if (!$this->ID_NguoiXN) {
            return 'Chờ xác nhận';
        }
        return 'Đã xác nhận';
    }

    public function getNgayBanGiaoAttribute($date)
    {
        if (!$date) {
            return null;
        }
        return FormatDate::formatDateTime($date);
    }
}
