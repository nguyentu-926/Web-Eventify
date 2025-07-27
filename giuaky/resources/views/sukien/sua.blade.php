<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="{{ route('sukien.update', $sukien->id) }}" method="POST" enctype="multipart/form-data">
    @csrf  <!-- Xác thực CSRF Token -->
    @method('PUT')  <!-- Chỉ định phương thức PUT -->

    <div>
        <label for="ten">Tên sự kiện:</label>
        <input type="text" name="ten" id="ten" value="{{ old('ten', default: $sukien->ten) }}" required>
    </div>

    <div>
        <label for="the_loai">Thể loại:</label>
        <input type="text" name="the_loai" id="the_loai" value="{{ old('the_loai', $sukien->the_loai) }}" required>
    </div>

    <div>
        <label for="ngay">Ngày sự kiện:</label>
        <input type="date" name="ngay" id="ngay" value="{{ old('ngay', \Carbon\Carbon::parse($sukien->ngay)->format('Y-m-d')) }}" required>
    </div>

    <div>
        <label for="dia_diem">Địa điểm:</label>
        <input type="text" name="dia_diem" id="dia_diem" value="{{ old('dia_diem', $sukien->dia_diem) }}" required>
    </div>

    <div>
        <label for="gia_ve">Giá vé:</label>
        <input type="number" name="gia_ve" id="gia_ve" value="{{ old('gia_ve', $sukien->gia_ve) }}" required>
    </div>

    <div>
        <label for="tong_cho_ngoi">Tổng số chỗ ngồi:</label>
        <input type="number" name="tong_cho_ngoi" id="tong_cho_ngoi" value="{{ old('tong_cho_ngoi', $sukien->tong_cho_ngoi) }}" required>
    </div>

    <div>
        <label for="mo_ta_su_kien">Mô tả sự kiện:</label>
        <textarea name="mo_ta_su_kien" id="mo_ta_su_kien" required>{{ old('mo_ta_su_kien', $sukien->mo_ta_su_kien) }}</textarea>
    </div>

    <div>
        <button type="submit">Lưu thay đổi</button>
    </div>
</form>


</body>
</html>