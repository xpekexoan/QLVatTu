<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietBanGiao extends Model
{
    protected $fillable = [
        'ID_Phieu', 'ID_VatTu', 'SoLuong'
    ];

    protected $table = 'ChiTietBanGiao';

    public function vatTu()
    {
        return $this->belongsTo(VatTu::class, 'ID_VatTu', 'ID');
    }

    public function phieuBanGiao()
    {
        return $this->belongsTo(PhieuBanGiao::class, 'ID_Phieu', 'ID');
    }
}
