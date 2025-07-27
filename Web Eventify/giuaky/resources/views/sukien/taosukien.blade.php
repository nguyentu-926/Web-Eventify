<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tạo Sự Kiện Mới</title>
    <style>
        /* Cấu trúc Flexbox để chia màn hình */
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Đảm bảo chiều cao chiếm hết màn hình */
            background-color: #f9f9f9;
            text-decoration: none;
        }

        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            text-decoration: none;
        }

        .form-container h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
            text-decoration: none;
        }

        .form-container label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
            color: #333;
            text-decoration: none;
        }

        .form-container input,
        .form-container select,
        .form-container textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            text-decoration: none;
        }

        .form-container textarea {
            resize: vertical;
            height: 150px;
            text-decoration: none;
        }

        .form-container button {
            width: 100%;
            padding: 12px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .form-container button:hover {
            background-color: #45a049;
            text-decoration: none;
        }

        .form-container input[type="file"] {
            padding: 5px;
            text-decoration: none;
        }

        .form-container .form-footer {
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
        }

        .form-container .form-footer a {
            color: #4CAF50;
            text-decoration: none;
        }

        .form-container .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-container">
            <h1>Tạo Sự Kiện Mới</h1>
            <form action="{{ route('sukien.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="ten">Tên sự kiện:</label>
                <input type="text" name="ten" id="ten" required placeholder="Nhập tên sự kiện">

                <label for="the_loai">Thể loại:</label>
                <select name="the_loai" id="the_loai" required>
                    <option value="Nhạc cải lương">Nhạc cải lương</option>
                    <option value="Nhạc trẻ">Nhạc trẻ</option>
                    <option value="Sân khấu & Nghệ thuật">Sân khấu & Nghệ thuật</option>
                    <option value="Thể thao">Thể thao</option>
                </select>

                <label for="ngay">Ngày tổ chức:</label>
                <input type="date" name="ngay" id="ngay" required>

                <label for="dia_diem">Địa điểm:</label>
                <input type="text" name="dia_diem" id="dia_diem" required placeholder="Nhập địa điểm tổ chức">

                <label for="gia_ve">Giá vé (VND):</label>
                <input type="number" name="gia_ve" id="gia_ve" required min="0" step="0.01" placeholder="Nhập giá vé">

                <label for="tong_cho_ngoi">Tổng số chỗ ngồi:</label>
                <input type="number" name="tong_cho_ngoi" id="tong_cho_ngoi" required min="1" placeholder="Nhập số chỗ ngồi">

                <label for="mo_ta_su_kien">Mô tả sự kiện:</label>
                <textarea name="mo_ta_su_kien" id="mo_ta_su_kien" placeholder="Mô tả chi tiết sự kiện..."></textarea>

                <label for="logo">Logo sự kiện (nếu có):</label>
                <input type="file" name="logo" id="logo" accept="image/*">

                <label for="background_image">Ảnh nền (nếu có):</label>
                <input type="file" name="background_image" id="background_image" accept="image/*">

                <button type="submit">Tạo sự kiện</button>
            </form>

            <div class="form-footer">
                <p><a href="{{ url('/') }}">Quay lại trang chủ</a></p>
            </div>
        </div>
    </div>
</body>
</html>
