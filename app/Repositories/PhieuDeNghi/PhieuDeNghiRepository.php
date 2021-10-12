<?php

namespace App\Repositories\PhieuDeNghi;

use App\Models\HanMuc;
use Carbon\Carbon;
use App\Models\ChiTietMua;
use App\Models\PhieuDeNghi;
use App\Repositories\BaseRepository;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class PhieuDeNghiRepository extends BaseRepository implements PhieuDeNghiInterface
{
    public function getModel()
    {
        return PhieuDeNghi::class;
    }

    public function getIDPhieuMua()
    {
        $now = Carbon::now();
        $code = 'PM';
        $month = $now->format('m');
        $year = $now->format('y');
        $prefix = $code . $month . $year;
        $last_field = $this->model->where('ID', 'like', "$prefix%")->orderby('ID', 'desc')->first();
        if (!$last_field) {
            $count = str_pad(1, 4, '0', STR_PAD_LEFT);
        } else {
            $count = intval(substr($last_field->ID, -4)) + 1;
            $count = str_pad($count, 4, '0', STR_PAD_LEFT);
        }
        $new_id = $prefix . $count;
        return $new_id;
    }

    public function listAll()
    {
        return $this->model->select()->orderby('TrangThai', 'asc')->orderby('NgayLapPhieu', 'desc')->paginate($this->limit);
    }

    public function myListPhieuMua()
    {
        return $this->model->select()->where('ID_NguoiDN', Auth::user()->ID)
            ->orderby('TrangThai', 'asc')->orderby('NgayLapPhieu', 'asc')->paginate($this->limit);
    }

    public function xetDuyetMua($data, $id)
    {
        try {
            DB::beginTransaction();
            PhieuDeNghi::find($id)->update([
                'ID_NVCSVC' => Auth::user()->ID, 'NgayDuKien' => $data['NgayDuKien'],
                'TrangThai' => 2
            ]);
            foreach ($data['vattu'] as $item) {
                if (!is_numeric($item['Gia']) || intval($item['Gia']) <= 1000) {
                    throw new \Exception();
                }
                $chiTiet = ChiTietMua::where('ID_Phieu', '=', $id)->where('ID_VatTu', '=', $item['ID_VatTu']);
                $chiTiet->update(['Gia' => $item['Gia']]);
            }
        } catch (\Throwable $e) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }

    public function hoanThanhPhieuMua($id)
    {
        $this->update($id, ['NgayHoanThanh' => now(), 'TrangThai' => 3]);
    }

    public function themPhieuMua($data)
    {
        $newID = $this->getIDPhieuMua();
        DB::beginTransaction();
        try {
            $this->model->insert([
                'ID' => $newID,
                'LoaiPhieu' => 1,
                'NgayLapPhieu' => now(),
                'TrangThai' => 1,
                'ID_NguoiDN' => Auth::user()->ID
            ]);
            foreach ($data as $item) {
                $idVatTu = $item['idTB'];
                $soLuong = $item['soLuong'];

                DB::table('chitietmua')->insert([
                    'ID_Phieu' => $newID,
                    'ID_VatTu' => $idVatTu,
                    'SoLuong' => $soLuong,
                ]);

                $hanMuc = HanMuc::where('ID_VPP', '=',  $idVatTu)
                    ->where('ID_KhoaPB', '=', Auth::user()->khoaPB->ID);
                $hanMucDaSD = $hanMuc->first()->HanMucDaSuDung;
                $hanMucToiDa = $hanMuc->first()->HanMucToiDa;
                if ($hanMucDaSD + $soLuong > $hanMucToiDa) {
                    throw new Exception();
                }

                $hanMuc->update(['HanMucDaSuDung' => $hanMucDaSD + $soLuong]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }

    public function xoaPhieuMua($id)
    {
        try {
            $phieu = $this->model->findOrFail($id);
            $chiTietMua = $phieu->chiTietMua;

            foreach ($chiTietMua as $item) {
                $hanMuc = HanMuc::where('ID_VPP', '=',  $item->ID_VatTu)
                    ->where('ID_KhoaPB', '=', Auth::user()->khoaPB->ID);
                $hanMucDaSD = $hanMuc->first()->HanMucDaSuDung;
                $hanMuc->update(['HanMucDaSuDung' => $hanMucDaSD - $item->SoLuong]);
            }

            DB::table('chitietmua')->where('ID_Phieu', '=', $id)->delete();
            $this->model->where('ID', '=', $id)->delete();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function suaPhieuMua($data, $id)
    {
        DB::beginTransaction();
        try {
            $phieu = $this->model->findOrFail($id);
            $chiTietMua = $phieu->chiTietMua;
            foreach ($chiTietMua as $item) {
                $hanMuc = HanMuc::where('ID_VPP', '=',  $item->ID_VatTu)
                    ->where('ID_KhoaPB', '=', Auth::user()->khoaPB->ID);
                $hanMucDaSD = $hanMuc->first()->HanMucDaSuDung;
                $hanMuc->update(['HanMucDaSuDung' => $hanMucDaSD - $item->SoLuong]);
            }
            DB::table('chitietmua')->where('ID_Phieu', '=', $id)->delete();

            foreach ($data as $item) {
                $idVatTu = $item['idTB'];
                $soLuong = $item['soLuong'];

                DB::table('chitietmua')->insert([
                    'ID_Phieu' => $id,
                    'ID_VatTu' => $idVatTu,
                    'SoLuong' => $soLuong,
                ]);

                $hanMuc = HanMuc::where('ID_VPP', '=',  $idVatTu)
                    ->where('ID_KhoaPB', '=', Auth::user()->khoaPB->ID);
                $hanMucDaSD = $hanMuc->first()->HanMucDaSuDung;
                $hanMucToiDa = $hanMuc->first()->HanMucToiDa;
                if ($hanMucDaSD + $soLuong > $hanMucToiDa) {
                    throw new Exception();
                }

                $hanMuc->update(['HanMucDaSuDung' => $hanMucDaSD + $soLuong]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }

    public function timKiem($q, $trangthai)
    {
        $data = $this->model->select()
            ->where('ID_NguoiDN', Auth::user()->ID)
            ->where('ID', 'like', '%' . $q . '%');

        if ($trangthai != -1) {
            $data = $data->where('TrangThai', '=', $trangthai);
        }

        return $data->orderby('TrangThai', 'asc')->orderby('NgayLapPhieu', 'asc')
            ->paginate($this->limit);
    }
}
