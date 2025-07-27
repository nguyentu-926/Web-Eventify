<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function destroy($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            return back()->with('success', 'Xóa tài khoản thành công!');
        }
        return back()->with('error', 'Không tìm thấy tài khoản!');
    }
    public function approveMultiple(Request $request)
{
    $sukienIds = $request->input('sukien_ids'); // Lấy danh sách ID sự kiện

    if (!$sukienIds) {
        return redirect()->route('admin.dashboard')->with('error', 'Vui lòng chọn ít nhất một sự kiện để duyệt.');
    }

    // Cập nhật trạng thái thành "đã duyệt"
    Sukien::whereIn('id', $sukienIds)->update(['trang_thai' => 'đã_duyệt']);

    return redirect()->route('admin.dashboard')->with('success', 'Các sự kiện đã được duyệt!');
}

    
}
