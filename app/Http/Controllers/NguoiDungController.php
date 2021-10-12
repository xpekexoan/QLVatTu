<?php

namespace App\Http\Controllers;

use App\Helpers\Facade\FormatDate;
use App\Http\Requests\User\UpdateInfo;
use App\Http\Requests\User\UpdatePassword;
use Illuminate\Http\Request;
use App\Repositories\NguoiDung\NguoiDungInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class NguoiDungController extends Controller
{
    protected $nguoiDungRepo;

    public function __construct(NguoiDungInterface $nguoiDungInterface)
    {
        $this->nguoiDungRepo = $nguoiDungInterface;
    }
    public function index()
    {
        $data = $this->nguoiDungRepo->list();
        return view('nguoidung.index', compact('data'));
    }

    public function profile()
    {
        return view('nguoidung.profile');
    }

    public function updateInfo(UpdateInfo $request)
    {
        $user = Auth::user();
        $data = $request->only(['HoTen', 'CMND', 'SDT', 'Email', 'NgaySinh']);
        $data['NgaySinh'] = FormatDate::formatToSQL($data['NgaySinh']);
        $this->nguoiDungRepo->update($user->ID, $data);
        return back()->with('alert-success', 'Cập nhật thông tin thành công!');
    }

    public function updatePassword(UpdatePassword $request)
    {
        $user = Auth::user();
        if (!Hash::check($request->MatKhau_current, $user->MatKhau)) {
            return back()
                ->withErrors(['MatKhau_current' => 'Mật khẩu hiện tại chưa đúng']);
        }
        $data['MatKhau'] = Hash::make($request->MatKhau);
        $this->nguoiDungRepo->update($user->ID, $data);
        return back()->with('alert-success', 'Thay đổi mật khẩu thành công!');
    }
}
