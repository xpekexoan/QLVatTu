<?php

namespace App\Repositories\VatTu;

use App\Repositories\RepositoryInterface;

interface VatTuInterface extends RepositoryInterface
{
    public function list();
    public function listVPP($q,$selected);
}
