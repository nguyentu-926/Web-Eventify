<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Sự kiện</title>
    <style>
        .sukien-container {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            display: flex;
            align-items: center;
        }
        .sukien-image {
            width: 150px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }
    </style>
</head>
<body>
     @include('layouts.header')
     <a href="{{ route('sukien.create') }}">➕ Thêm Sự Kiện Mới</a>
    <h1>Danh sách Sự kiện</h1>

    @foreach($sukiens as $sukien) 
        <div class="sukien-container">
            <!-- Hiển thị ảnh nếu có -->
            @if($sukien->logo)
                <img src="{{ asset('storage/' . $sukien->logo) }}" alt="Logo {{ $sukien->ten }}" class="sukien-image">
            @else
                <img src="{{ asset('images/default-event.png') }}" alt="Sự kiện mặc định" class="sukien-image">
            @endif

            <div>
                <h3>Tên sự kiện{{ $sukien->ten }}</h3>
                <p><strong>Thể loại:</strong> {{ $sukien->the_loai }}</p>
                <p><strong>Ngày tổ chức:</strong> {{ \Carbon\Carbon::parse($sukien->ngay)->format('d/m/Y') }}</p>
                <p><strong>Mô tả:</strong> {{ Str::limit($sukien->mo_ta_su_kien, 100) }}</p>
                <p><strong>Tổng số vé:</strong> {{ $sukien->tong_cho_ngoi }}</p>
                <p><strong>Giá vé:</strong> {{ number_format($sukien->gia_ve, 0, ',', '.') }} VND</p>
                <p><strong>Trạng thái:</strong> 
                    @if($sukien->trang_thai == 'đã_duyệt')
                        ✅ Đã duyệt
                    @else
                        ⏳ Chờ duyệt
                    @endif
                </p>
                 <!-- Nút Sửa -->
        <a href="{{ route('sukien.edit', $sukien->id) }}" class="btn btn-warning">✏️ Sửa</a>

        <!-- Nút Xóa -->
         <form action="{{ route('sukien.destroy', $sukien->id) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa?')">🗑️ Xóa</button>
       </form>

                <a href="{{ route('sukien.show', $sukien->id) }}">📌 Xem chi tiết</a>
            </div>
        </div>
    @endforeach

    @if (session('success'))
        <div style="color: green; font-weight: bold;">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div style="color: red; font-weight: bold;">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ url('/') }}">🏠 Về trang chủ</a>
</body>
</html>
