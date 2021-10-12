<?php

namespace App\Repositories\HanMuc;

use App\Repositories\RepositoryInterface;

interface HanMucInterface extends RepositoryInterface
{
    public function getHanMuc($id);
}
