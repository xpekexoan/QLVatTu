<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhieuDeXuat extends Model
{
    protected $fillable = [
        'ID_NguoiYC', 'TenVatTu', 'NgayDeXuat', 'TrangThai'
    ];

    protected $primaryKey = 'ID';

    protected $table = 'PhieuDeXuatVatTu';

    const CREATED_AT = 'NgayDeXuat';

    protected $attributes = [
        'TrangThai' => false,
    ];
}
