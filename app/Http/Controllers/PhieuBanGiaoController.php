<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Repositories\PhieuBanGiao\PhieuBanGiaoInterface;
use App\Repositories\PhieuDeNghi\PhieuDeNghiInterface;

class PhieuBanGiaoController extends Controller
{
    protected $phieuBanGiaoRepo;
    protected $phieuDeNghiRepo;
    public function __construct(
        PhieuBanGiaoInterface $phieuBanGiaoInterface,
        PhieuDeNghiInterface $phieuDeNghiInterface
    ) {
        $this->phieuBanGiaoRepo = $phieuBanGiaoInterface;
        $this->phieuDeNghiRepo = $phieuDeNghiInterface;
    }

    public function index()
    {
        if (Auth::user()->LoaiTK == 2) {
            $data = $this->phieuBanGiaoRepo->list();
        } else {
            $data = $this->phieuBanGiaoRepo->myList();
        }
        return view('phieubangiao.index', compact('data'));
    }

    public function showCreateform($id)
    {
        $newID = $this->phieuBanGiaoRepo->getIDPhieuBG();
        $phieu = $this->phieuDeNghiRepo->findOrFail($id);
        if ($phieu->TrangThai == 1) {
            return back()->with('alert-fail', 'Phiếu chưa được duyệt');
        }
        return view('phieubangiao.create', compact(['newID', 'phieu']));
    }

    public function create(Request $request, $id)
    {
        $data = $request->get('data');
        $newID = $this->phieuBanGiaoRepo->themBanGiao($data, $id);
        if ($newID) {
            return response()->json($newID);
        }
        return response()->json(['message' => 'Fail'], 404);
    }

    public function detail($id)
    {
        $phieu = $this->phieuBanGiaoRepo->findOrFail($id);
        if (Gate::denies('phieubangiao-detailPolicy', $phieu)) {
            return redirect(route('index'))->with('alert-fail', 'Không thể truy cập');
        };
        return view('phieubangiao.detail', compact('phieu'));
    }

    public function xacNhan($id_phieuBG)
    {
        $phieu = $this->phieuBanGiaoRepo->findOrFail($id_phieuBG);
        if (Gate::denies('phieubangiao-xacNhanPolicy', $phieu)) {
            return redirect(route('index'))->with('alert-fail', 'Không thể truy cập');
        };
        $this->phieuBanGiaoRepo->xacNhan($id_phieuBG);
        return back()->with('alert-success', 'Xác nhận phiếu bàn giao thành công');
    }

    public function update(Request $request, $id)
    {
        $data = $request->get('data');
        $status = $this->phieuBanGiaoRepo->suaBanGiao($data, $id);
        if ($status) {
            return response()->json(['message' => 'Success']);
        }
        return response()->json(['message' => 'Fail'], 404);
    }

    public function delete($id)
    {
        if ($this->phieuBanGiaoRepo->delete($id)) {
            return back()->with('alert-fail', 'Xóa thất bại');
        }
        return back()->with('alert-success', 'Xóa thành công');
    }
}
