<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\HanMuc\HanMucInterface;
use Illuminate\Support\Facades\Auth;

class HanMucController extends Controller
{
    protected $hanMucRepo;
    
    public function __construct(HanMucInterface $hanMucInterface)
    {
        $this->hanMucRepo = $hanMucInterface;
    }

    public function getHanMuc(Request $request)
    {
        $data = $this->hanMucRepo->getHanMuc($request->input('id'));
        foreach ($data as $item) {
            $item['DonViTinh'] = array_values($item->VatTu->all())[0]['DonViTinh'];
        }
        return response()->json($data);
    }
}
