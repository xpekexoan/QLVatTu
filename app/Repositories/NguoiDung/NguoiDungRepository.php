<?php

namespace App\Repositories\NguoiDung;

use App\Models\NguoiDung;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Model;

class NguoiDungRepository extends BaseRepository implements NguoiDungInterface
{
    public function getModel()
    {
        return NguoiDung::class;
    }

    public function list() {
        return $this->model->select()->orderby('ID', 'desc')->paginate($this->limit);
    }
    // public function getuserinfo($id){
    //     return $this->model->select($id);
    // }
}
