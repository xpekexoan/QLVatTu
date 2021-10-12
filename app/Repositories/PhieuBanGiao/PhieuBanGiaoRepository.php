<?php

namespace App\Repositories\PhieuBanGiao;

use Exception;
use Carbon\Carbon;
use App\Models\PhieuBanGiao;
use App\Models\ChiTietBanGiao;
use Illuminate\Support\Facades\DB;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Auth;

class PhieuBanGiaoRepository extends BaseRepository implements PhieuBanGiaoInterface
{
    public function getModel()
    {
        return PhieuBanGiao::class;
    }

    public function getIDPhieuBG()
    {
        $now = Carbon::now();
        $code = 'BG';
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

    public function list()
    {
        $query = $this->model->select();
        return $query->orderby('ID_NguoiXN', 'asc')->orderby('NgayBanGiao', 'desc')->paginate($this->limit);
    }

    public function myList()
    {
        $query = PhieuBanGiao::join('PhieuDeNghi', 'PhieuDeNghi.ID', '=', 'PhieuBanGiao.ID_PhieuDN')
            ->where('PhieuDeNghi.ID_NguoiDN', '=', Auth::user()->ID)->select('PhieuBanGiao.*');
        return $query->orderby('ID_NguoiXN', 'asc')->orderby('NgayBanGiao', 'desc')->paginate($this->limit);
    }

    public function xacNhan($id_phieuBG)
    {
        $this->update($id_phieuBG, ['ID_NguoiXN' => Auth::user()->ID, 'NgayBanGiao' => now()]);
    }

    public function themBanGiao($data, $id_phieuDN)
    {
        $newID = $this->getIDPhieuBG();
        DB::beginTransaction();
        $this->model->insert([
            'ID' => $newID,
            'ID_PhieuDN' => $id_phieuDN,
            'ID_NVCSVC' => Auth::user()->ID
        ]);
        try {
            foreach ($data as  $item) {
                $soLuongBG = $item['soLuong'];
                $id_vatTu = $item['ID_VatTu'];
                if ($soLuongBG <= 0) {
                    throw new Exception();
                };
                DB::table('ChiTietBanGiao')->insert([
                    'ID_Phieu' => $newID,
                    'ID_VatTu' => $id_vatTu,
                    'SoLuong' => $soLuongBG,
                ]);
            }
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return $newID;
    }

    public function suaBanGiao($data, $id = null)
    {
        DB::beginTransaction();
        try {
            foreach ($data as $item) {
                $soLuongBG = $item['soLuong'];
                $id_vatTu = $item['ID_VatTu'];
                $chiTiet = DB::table('chitietbangiao')->where('ID_Phieu', $id)->where('ID_VatTu', $id_vatTu);
                if ($soLuongBG > 0) {
                    if ($chiTiet->first()) {
                        $chiTiet->update(['SoLuong' => $soLuongBG]);
                    } else {
                        DB::table('ChiTietBanGiao')->insert([
                            'ID_Phieu' => $id,
                            'ID_VatTu' => $id_vatTu,
                            'SoLuong' => $soLuongBG,
                        ]);
                    }
                } else {
                    $chiTiet->delete();
                }
            }
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }

    public function delete($id)
    {
        try {
            DB::table('chitietbangiao')->where('ID_Phieu', '=', $id)->delete();
            DB::table('phieubangiao')->where('ID', '=', $id)->delete();
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
