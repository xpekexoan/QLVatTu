<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HanMuc extends Model
{
    protected $fillable = [
        'ID_KhoaPB', 'ID_VPP', 'HanMucDaSuDung', 'HanMucToiDa', 'NgayBatDau'
    ];

    protected $table = 'HanMuc';
    protected $primaryKey = ['ID_KhoaPB', 'ID_VPP'];
    public $incrementing = false;
    
    public function VatTu()
    {
        return $this->hasMany(VatTu::class, 'ID', 'ID_VPP');
    }
}
