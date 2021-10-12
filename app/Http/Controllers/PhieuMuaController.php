<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\PhieuMua\CreatePhieuMua;
use App\Repositories\PhieuDeNghi\PhieuDeNghiInterface;
use Illuminate\Http\Request;

class PhieuMuaController extends Controller
{
    protected $phieuMuaRepo;

    public function __construct(PhieuDeNghiInterface $phieuDeNghiInterface)
    {
        $this->phieuMuaRepo = $phieuDeNghiInterface;
    }

    public function index()
    {
        // dd($this->phieuMuaRepo->myListPhieuMua());
        $data = $this->phieuMuaRepo->myListPhieuMua();
        return view('phieudenghi.mua.index', compact('data'));
    }

    public function timKiemPhieuMua(Request $request)
    {
        $trangthai = $request->has('trangthai') ? $request->get('trangthai') : -1;
        $data = $this->phieuMuaRepo->timKiem($request->get('q'), $trangthai);
        return view('phieudenghi.mua.index', compact('data'));
    }

    public function showCreate()
    {
        return view('phieudenghi.mua.create');
    }

    public function create(Request $request)
    {
        $data = $request->get('data');
        $status = $this->phieuMuaRepo->themPhieuMua($data);
        if ($status) {
            return response()->json($data);
        }
        return response()->json(['message' => 'error'], 404);
    }

    public function detail($id)
    {
        $phieu = $this->phieuMuaRepo->findOrFail($id);
        if (Gate::denies('phieudenghi-detailPolicy', $phieu)) {
            return redirect(route('index'))->with('alert-fail', 'Không thể truy cập');
        };
        return view('phieudenghi.mua.detail', compact('phieu'));
    }

    public function showEdit($id)
    {
        $phieu = $this->phieuMuaRepo->findOrFail($id);
        if (Gate::denies('phieudenghi-editPolicy', $phieu)) {
            return redirect(route('index'))->with('alert-fail', 'Không thể truy cập');
        };
        // return view('phieudenghi.mua.edit', compact('phieu'));
        return view('phieudenghi.mua.edit')->with(compact('phieu'))
            ->with(compact('id'));
    }

    public function edit(Request $request, $id)
    {
        $phieu = $this->phieuMuaRepo->findOrFail($id);
        if (Gate::denies('phieudenghi-editPolicy', $phieu)) {
            return redirect(route('index'))->with('alert-fail', 'Không thể truy cập');
        };
        $data = $request->get('data');
        $status = $this->phieuMuaRepo->suaPhieuMua($data, $id);
        if ($status) {
            return response()->json($data);
        }
        return response()->json(['message' => 'error'], 404);
        // return response()->json($data);
    }

    public function delete($id)
    {
        if ($this->phieuMuaRepo->xoaPhieuMua($id)) {
            return back()->with('alert-success', 'Xóa thành công');
        }
        return back()->with('alert-success', 'Xóa thất bại');
    }

    public function hoanThanh($id)
    {
        $phieu = $this->phieuMuaRepo->findOrFail($id);
        if (Gate::denies('phieudenghi-hoanThanhPolicy', $phieu)) {
            return redirect(route('index'))->with('alert-fail', 'Không thể truy cập');
        };
        $this->phieuMuaRepo->hoanThanhPhieuMua($id);
        return back()->with('alert-success', 'Xác nhận hoàn thành phiếu đề nghị thành công');
    }

    public function confirm()
    {
    }
}
