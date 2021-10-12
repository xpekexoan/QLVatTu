<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;

class KhoaPhongBan extends Model
{
    protected $fillable = [
        'Ten', 'Loai'
    ];

    protected $table = 'KhoaPhongBan';

    protected $primaryKey = 'ID';
    public $incrementing = false;

    public function soLuongphieuMua($m = null, $y = null)
    {
        $query = DB::table('khoaphongban')
            ->join('nguoidung', 'khoaphongban.id', '=', 'nguoidung.ID_KhoaPB')
            ->join('phieudenghi', 'nguoidung.id', '=', 'phieudenghi.ID_NguoiDN')
            ->where('khoaphongban.ID', $this->ID)
            ->where('phieudenghi.LoaiPhieu', '1')
            ->groupBy('khoaphongban.ID')
            ->select(array('khoaphongban.ID', DB::raw('COUNT(*) as sl')));

        if ($m) {
            $query = $query->whereMonth('phieudenghi.NgayLapPhieu', $m);
        }

        if ($y) {
            $query = $query->whereYear('phieudenghi.NgayLapPhieu', $y);
        } else {
            $query = $query->whereYear('phieudenghi.NgayLapPhieu', now()->year);
        }
        $query = $query->first();
        $soLuong = $query ? $query->sl : 0;
        return $soLuong;
    }

    public function soLuongPhieuSua($m = null, $y = null)
    {
        $query = DB::table('khoaphongban')
            ->join('nguoidung', 'khoaphongban.id', '=', 'nguoidung.ID_KhoaPB')
            ->join('phieudenghi', 'nguoidung.id', '=', 'phieudenghi.ID_NguoiDN')
            ->where('khoaphongban.ID', $this->ID)
            ->where('phieudenghi.LoaiPhieu', '2')
            ->groupBy('khoaphongban.ID')
            ->select(array('khoaphongban.ID', DB::raw('COUNT(*) as sl')));

        if ($m) {
            $query = $query->whereMonth('phieudenghi.NgayLapPhieu', $m);
        }

        if ($y) {
            $query = $query->whereYear('phieudenghi.NgayLapPhieu', $y);
        } else {
            $query = $query->whereYear('phieudenghi.NgayLapPhieu', now()->year);
        }
        
        $query = $query->first();
        $soLuong = $query ? $query->sl : 0;
        return $soLuong;
    }
}
