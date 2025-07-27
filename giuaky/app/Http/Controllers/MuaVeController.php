<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ves;
use App\Models\Sukien;
use Illuminate\Support\Facades\Auth;

class MuaVeController extends Controller
{
    // Xử lý mua vé
    public function muaVe($id)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để mua vé.');
        }

        $suKien = Sukien::findOrFail($id);

        // Kiểm tra vé có còn không
        if ($suKien->tong_cho_ngoi <= 0) {
            return redirect()->back()->with('error', 'Vé đã hết.');
        }

        // Lưu vé vào database
        Ves::create([
            'user_id' => Auth::id(),
            'sukien_id' => $suKien->id,
            'so_luong' => 1, // Mặc định 1 vé
        ]);

        // Giảm số lượng vé còn lại
        $suKien->decrement('tong_cho_ngoi');

        return redirect()->route('ve_cua_toi')->with('success', 'Mua vé thành công!');
    }

    // Hiển thị danh sách vé của tôi
    public function veCuaToi()
    {
        $veCuaToi = Ves::where('user_id', Auth::id())->with('sukien')->get();

        return view('ve_cua_toi', compact('veCuaToi'));
    }
}

