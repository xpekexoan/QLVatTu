<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietSua extends Model
{
    protected $fillable = [
        'ID_Phieu', 'ID_VatTu', 'ChiPhiSua', 'TinhTrangSua', 'LyDo'
    ];

    protected $table = 'ChiTietSua';

    public function vatTu()
    {
        return $this->belongsTo(VatTu::class, 'ID_VatTu', 'ID');
    }
}
