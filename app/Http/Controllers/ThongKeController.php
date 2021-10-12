<?php

namespace App\Http\Controllers;

use App\Models\KhoaPhongBan;
use App\Models\PhieuDeNghi;
use Illuminate\Http\Request;

class ThongKeController extends Controller
{
    public function index(Request $request)
    {
        $m = $request->get('m');
        $y = $request->get('y') ? $request->get('y') : now()->year;
        $phieuMua = PhieuDeNghi::where('LoaiPhieu', '1')->where('TrangThai', '!=', 1);
        $phieuSua = PhieuDeNghi::where('LoaiPhieu', '2')->where('TrangThai', '!=', 1);
        $phieuChoDuyet = PhieuDeNghi::where('TrangThai', '1');
        $chiPhiMua = $phieuMua->join('chitietmua', 'phieudenghi.ID', '=', 'chitietmua.ID_Phieu');
        $chiPhiSua = $phieuSua->join('chitietsua', 'phieudenghi.ID', '=', 'chitietsua.ID_Phieu');

        if ($m) {
            $phieuMua = $phieuMua->whereMonth('NgayLapPhieu', $m);
            $phieuSua = $phieuSua->whereMonth('NgayLapPhieu', $m);
            $phieuChoDuyet = $phieuChoDuyet->whereMonth('NgayLapPhieu', $m);
            $chiPhiMua = $chiPhiMua->whereMonth('PhieuDeNghi.NgayLapPhieu', $m);
            $chiPhiSua = $chiPhiSua->whereMonth('PhieuDeNghi.NgayLapPhieu', $m);
        }
        if ($y) {
            $phieuMua = $phieuMua->whereYear('NgayLapPhieu', $y);
            $phieuSua = $phieuSua->whereYear('NgayLapPhieu', $y);
            $phieuChoDuyet = $phieuChoDuyet->whereYear('NgayLapPhieu', $y);
            $chiPhiMua = $chiPhiMua->whereYear('PhieuDeNghi.NgayLapPhieu', $y);
            $chiPhiSua = $chiPhiSua->whereYear('PhieuDeNghi.NgayLapPhieu', $y);
        }
        $phieuMua = $phieuMua->get();
        $phieuSua = $phieuSua->get();
        $phieuChoDuyet = $phieuChoDuyet->get();
        $chiPhiMua = $chiPhiMua->sum('Gia');
        $chiPhiSua = $chiPhiSua->sum('chitietsua.ChiPhiSua');
        $khoaPB = KhoaPhongBan::all();
        return view('thongke.index', compact('phieuMua', 'phieuSua', 'khoaPB', 'phieuChoDuyet', 'chiPhiMua', 'chiPhiSua'));
    }
}
