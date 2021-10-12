<?php

namespace App\Repositories\VatTu;

use App\Models\VatTu;
use App\Repositories\BaseRepository;

class VatTuRepository extends BaseRepository implements VatTuInterface
{
    public function getModel()
    {
        return VatTu::class;
    }

    public function list()
    {
        return $this->model->select()->paginate($this->limit);
    }
    
    public function listVPP($q, $selected)
    {
        return $this->model->select('VatTu.*')->where('LoaiVT', '=', 1)
            ->where('Ten', 'like', '%' . $q . '%', 'AND')
            ->whereNotIn('ID', $selected)->get();
    }
}
