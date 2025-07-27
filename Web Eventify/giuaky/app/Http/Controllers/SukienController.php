<?php

namespace App\Http\Controllers;

use App\Models\Sukien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class SukienController extends Controller
{// Hiển thị danh sách sự kiện đã duyệt
    public function index(Request $request)
{
    // Kiểm tra nếu có filter trạng thái, nếu không lấy tất cả sự kiện
    $status = $request->input('status');
    $query = Sukien::query();

    if ($status) {
        $query->where('trang_thai', $status);
    }

    $sukiens = $query->get(); // Lấy sự kiện theo trạng thái

    return view('sukien.chi_tiet_su_kien', compact('sukiens'));
}

    // Controller SukienController


    // Hiển thị chi tiết một sự kiện
    public function show($id)
    {
        $sukien = Sukien::findOrFail($id);
        $sukiens = Sukien::all(); // Lấy tất cả sự kiện
    
        return view('sukien.chi_tiet_su_kien', compact('sukien', 'sukiens'));
    }

    // Duyệt sự kiện
    public function approve($id)
    {
        $sukien = Sukien::findOrFail($id);
        $sukien->update(['trang_thai' => 'đã_duyệt']);
    
        return redirect()->route('sukien.index')->with('success', 'Sự kiện đã được duyệt!');
    }

    // Trả về form tạo sự kiện
    public function create()
    {
        return view('sukien.taosukien');
    }
    // edit sự kiện
    public function edit($id)
    {
    $sukien = Sukien::findOrFail($id);
    return view('sukien.sua', compact('sukien'));
    }
    // udate sau khi edit
    public function update(Request $request, $id)
{
    // Lấy sự kiện cần sửa từ DB
    $sukien = Sukien::findOrFail($id);

    // Validate dữ liệu
    $request->validate([
        'ten' => 'required|string|max:255',
        'the_loai' => 'required|in:Nhạc cải lương,Nhạc trẻ,Sân khấu & Nghệ thuật,Thể thao',
        'ngay' => 'required|date_format:Y-m-d',
        'dia_diem' => 'required|string|max:255',
        'gia_ve' => 'required|numeric|min:0',
        'tong_cho_ngoi' => 'required|integer|min:1',
        'mo_ta_su_kien' => 'nullable|string',
        'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'background_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Lấy dữ liệu từ request
    $data = $request->only(['ten', 'the_loai', 'ngay', 'dia_diem', 'gia_ve', 'tong_cho_ngoi', 'mo_ta_su_kien']);

    // Xử lý logo (nếu có file ảnh logo mới)
    if ($request->hasFile('logo')) {
        // Xóa logo cũ nếu có
        if ($sukien->logo) {
            Storage::delete($sukien->logo);
        }
        // Lưu logo mới
        $data['logo'] = $request->file('logo')->store('sukiens/logos', 'public');
    }

    // Xử lý background image (nếu có file ảnh nền mới)
    if ($request->hasFile('background_image')) {
        // Xóa ảnh nền cũ nếu có
        if ($sukien->background_image) {
            Storage::delete($sukien->background_image);
        }
        // Lưu ảnh nền mới
        $data['background_image'] = $request->file('background_image')->store('sukiens/backgrounds', 'public');
    }

    // Cập nhật sự kiện
    $sukien->update($data);

    // Quay lại trang chi tiết sự kiện với thông báo thành công
    return redirect()->route('sukien.show', $sukien->id)->with('success', 'Sự kiện đã được cập nhật!');
}

public function destroy($id)
{
    $sukien = Sukien::findOrFail($id);

    // Xóa logo nếu có
    if ($sukien->logo) {
        Storage::delete($sukien->logo);
    }

    // Xóa background_image nếu có
    if ($sukien->background_image) {
        Storage::delete($sukien->background_image);
    }

    // Xóa sự kiện
    $sukien->delete();

    // Quay lại trang danh sách sự kiện với thông báo thành công
    return redirect()->route('sukien.index')->with('success', 'Sự kiện đã được xóa!');
}






    // Xử lý lưu sự kiện
    public function store(Request $request)
{
    $request->validate([
        'ten' => 'required|string|max:255',
        'the_loai' => 'required|in:Nhạc cải lương,Nhạc trẻ,Sân khấu & Nghệ thuật,Thể thao', // Phải khớp ENUM trong DB
        'ngay' => 'required|date_format:Y-m-d',
        'dia_diem' => 'required|string|max:255',
        'gia_ve' => 'required|numeric|min:0',
        'tong_cho_ngoi' => 'required|integer|min:1',
        'mo_ta_su_kien' => 'nullable|string',
        'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'background_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    // Lấy dữ liệu hợp lệ từ request
    $data = $request->only(['ten', 'the_loai', 'ngay', 'dia_diem', 'gia_ve', 'tong_cho_ngoi', 'mo_ta_su_kien']);

    // Xử lý ảnh
    if ($request->hasFile('logo')) {
        $file = $request->file('logo');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $data['logo'] = $file->storeAs('sukiens/logos', $fileName, 'public');
    }

    if ($request->hasFile('background_image')) {
        $file = $request->file('background_image');
        $fileName = time() . '_' . $file->getClientOriginalName();
        $data['background_image'] = $file->storeAs('sukiens/backgrounds', $fileName, 'public');
    }

    try {
        $sukien = Sukien::create($data);
        return redirect()->route('sukien.show', $sukien->id)
                 ->with('success', 'Sự kiện đã được tạo thành công!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Lỗi: ' . $e->getMessage());
    }
}

}
