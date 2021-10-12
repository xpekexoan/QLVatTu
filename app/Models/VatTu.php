<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VatTu extends Model
{
    protected $fillable = [
        'Ten', 'DonViTinh', 'Phong', 'LoaiVT'
    ];

    protected $table = 'VatTu';

    protected $primaryKey = 'ID';
    
    public function HanMuc()
    {
        return $this->hasMany(HanMuc::class, 'ID_VPP', 'ID');
    }
}
