<?php

namespace App\Repositories\HanMuc;

use App\Models\HanMuc;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class HanMucRepository extends BaseRepository implements HanMucInterface
{
    public function getModel()
    {
        return HanMuc::class;
    }

    public function getHanMuc($id)
    {
        return $this->model->select()->where('ID_VPP','=',$id)
                                     ->where('ID_KhoaPB','=',Auth::user()->ID_KhoaPB)
                                     ->get();
    }
}
