<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\PhieuDeNghi\PhieuDeNghiInterface;

class XetDuyetController extends Controller
{
    protected $phieuDeNghiRepo;

    public function __construct(PhieuDeNghiInterface $phieuDeNghiInterface)
    {
        $this->phieuDeNghiRepo = $phieuDeNghiInterface;
    }

    public function index()
    {
        $data = $this->phieuDeNghiRepo->listAll();
        return view('phieudenghi.index', compact('data'));
    }

    public function detail($id)
    {
        $phieu = $this->phieuDeNghiRepo->findOrFail($id);
        if ($phieu->LoaiPhieu == 1) {
            return view('phieudenghi.mua.xetduyet', compact('phieu'));
        } else {
            return view('phieudenghi.sua.xetduyet', compact('phieu'));
        }
    }

    public function xetDuyet(Request $request, $id)
    {
        $data = $request->only('vattu','NgayDuKien');
        if ($this->phieuDeNghiRepo->xetDuyetMua($data, $id)) {
            return response()->json(['message' => 'Thành công']);
        }
        return response()->json(['message' => 'Thất bại'], 404);
    }

    public function ghiChu(Request $request, $id)
    {
        $data = $request->get('GhiChu');
        $this->phieuDeNghiRepo->findOrFail($id)->update(['GhiChu' => $data]);
        return response()->json($data);
    }
}
