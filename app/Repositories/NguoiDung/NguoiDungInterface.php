<?php 
namespace App\Repositories\NguoiDung;

use App\Repositories\RepositoryInterface;

interface NguoiDungInterface extends RepositoryInterface {
    public function list();
}
