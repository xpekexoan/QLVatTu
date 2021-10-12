<?php

namespace App\Http\Controllers;

use App\Repositories\VatTu\VatTuInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VatTuController extends Controller
{
    protected $vatTuRepo;
    public function __construct(VatTuInterface $vatTuInterface)
    {
        $this->vatTuRepo = $vatTuInterface;
    }

    public function index()
    {
        $data = $this->vatTuRepo->list();
        return view('vattu.index', compact('data'));
    }

    public function listVPP(Request $request)
    {
        $q = $request->has('q') ? $request->get('q') : '';
        $selected = $request->has('selected') ? $request->get('selected') : [-1];
        $data = $this->vatTuRepo->listVPP($q, $selected);
        foreach ($data as $item) {
            $item['HanMucToiDa'] = array_values($item->HanMuc->where('ID_KhoaPB', '=', Auth::user()->ID_KhoaPB)->all())[0]['HanMucToiDa'];
            $item['HanMucDaSuDung'] = array_values($item->HanMuc->where('ID_KhoaPB', '=', Auth::user()->ID_KhoaPB)->all())[0]['HanMucDaSuDung'];
        }
        return response()->json($data);
    }

    public function listTB()
    {
    }
}
