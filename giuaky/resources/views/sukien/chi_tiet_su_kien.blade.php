<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách Sự kiện</title>
    <style>
        .main-content {
    flex: 1;
    padding: 20px;
    overflow-y: auto; /* Thêm để nội dung có thể cuộn khi cần */
    margin-top: 60px; /* Thêm khoảng cách từ trên cùng để tránh bị che khuất bởi header */
    text-decoration: none;
}

        /* Cấu trúc Flexbox để chia màn hình */
        .container {
            display: flex;
            height: 100vh; /* Đảm bảo chiều cao chiếm hết màn hình */
            text-decoration: none;
        }

        /* Bên trái: menu */
        .sidebar {
            width: 250px;
            padding: 20px;
            background-color: rgba(255,240,245);
            border-right: 1px solid #ddd;
            text-decoration: none;

        }

        .sidebar a {
            display: block;
            padding: 10px;
            margin: 5px 0;
            background-color: rgba(255,105,180);
            text-decoration: none;
            color: #333;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: rgba(255,240,245);
            text-decoration: none;
        }

        /* Bên phải: nội dung chính */
        .main-content {
            flex: 1;
            padding: 20px;
            text-decoration: none;
        }

        /* Sự kiện Container */
        .sukien-container {
            border: 1px solid #ddd;
            padding: 15px;
            margin: 10px 0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            text-decoration: none;
        }

        .sukien-image {
            width: 150px;
            height: 300px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
            text-decoration: none;
        }
    </style>
</head>
<body>
     @include('layouts.header')
     <div class="container">
        <!-- Sidebar - Bên trái -->
        <div class="sidebar">
            <a href="#" onclick="loadContent('event')">Sự kiện</a>
            <a href="#" onclick="loadContent('create_event')">Tạo sự kiện mới</a>  <!-- Thêm mục "Tạo sự kiện" -->
            <a href="#" onclick="loadContent('events')">Sự kiện đã tạo</a>
            <a href="#" onclick="loadContent('terms')">Điều khoản ban tổ chức</a>
            <a href="#" onclick="loadContent('status')">Trạng thái duyệt sự kiện</a>
        </div>

        <!-- Nội dung chính - Bên phải -->
        <div class="main-content" id="content">
            <!-- Nội dung sẽ được load ở đây -->
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
                    <p><strong style=" text-decoration: none;">Tên sự kiện:</strong> {{ Str::limit($sukien->ten, 100) }}</p>
                        <p><strong style=" text-decoration: none;">Thể loại:</strong> {{ $sukien->the_loai }}</p>
                        <p><strong style=" text-decoration: none;">Ngày tổ chức:</strong> {{ \Carbon\Carbon::parse($sukien->ngay)->format('d/m/Y') }}</p>
                        <p><strong style=" text-decoration: none;">Mô tả:</strong> {{ Str::limit($sukien->mo_ta_su_kien, 100) }}</p>
                        <p><strong style=" text-decoration: none;">Tổng số vé:</strong> {{ $sukien->tong_cho_ngoi }}</p>
                        <p><strong style=" text-decoration: none;">Giá vé:</strong> {{ number_format($sukien->gia_ve, 0, ',', '.') }} VND</p>
                        <a  style="display: inline-block; padding: 10px 20px; background: rgba(255, 105, 180, 1); color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
            Mua vé ngay
        </a>
                       
                        </form>
                        <a href="{{ route('sukien.show', $sukien->id) }}">
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

        </div>
    </div>

    <script>
        function loadContent(page) {
            // Chức năng thay đổi nội dung dựa trên mục click
            let content = '';
            if (page === 'event') {
                content = `
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
                <p><strong style=" text-decoration: none;">Tên sự kiện:</strong> {{ Str::limit($sukien->ten, 100) }}</p>
                <p><strong style=" text-decoration: none;">Thể loại:</strong> {{ $sukien->the_loai }}</p>
                <p><strong style=" text-decoration: none;">Ngày tổ chức:</strong> {{ \Carbon\Carbon::parse($sukien->ngay)->format('d/m/Y') }}</p>
                <p><strong style=" text-decoration: none;">Mô tả:</strong> {{ Str::limit($sukien->mo_ta_su_kien, 100) }}</p>
                <p><strong style=" text-decoration: none;">Tổng số vé:</strong> {{ $sukien->tong_cho_ngoi }}</p>
                <p><strong style=" text-decoration: none;">Giá vé:</strong> {{ number_format($sukien->gia_ve, 0, ',', '.') }} VND</p>
                <a style=" text-decoration: none;" href="{{ route('sukien.show', $sukien->id) }}">
        <a  style="display: inline-block; padding: 10px 20px; background: rgba(255, 105, 180, 1); color: white; text-decoration: none; border-radius: 5px; font-weight: bold;">
            Mua vé ngay
        </a>
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
                `;
            } else if (page === 'create_event') {
                content = `
                    
                    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;padding-top: 150px">
        <div style="background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); width: 100%; max-width: 600px;">
            <h1 style="text-align: center; margin-bottom: 20px; color: #333;">Tạo Sự Kiện Mới</h1>
            
            <form action="{{ route('sukien.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <label for="ten" style="display: block; margin: 10px 0 5px; font-weight: bold; color: #333;">Tên sự kiện:</label>
                <input type="text" name="ten" id="ten" required placeholder="Nhập tên sự kiện" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">

                <label for="the_loai" style="display: block; margin: 10px 0 5px; font-weight: bold; color: #333;">Thể loại:</label>
                <select name="the_loai" id="the_loai" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                    <option value="Nhạc cải lương">Nhạc cải lương</option>
                    <option value="Nhạc trẻ">Nhạc trẻ</option>
                    <option value="Sân khấu & Nghệ thuật">Sân khấu & Nghệ thuật</option>
                    <option value="Thể thao">Thể thao</option>
                </select>

                <label for="ngay" style="display: block; margin: 10px 0 5px; font-weight: bold; color: #333;">Ngày tổ chức:</label>
                <input type="date" name="ngay" id="ngay" required style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">

                <label for="dia_diem" style="display: block; margin: 10px 0 5px; font-weight: bold; color: #333;">Địa điểm:</label>
                <input type="text" name="dia_diem" id="dia_diem" required placeholder="Nhập địa điểm tổ chức" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">

                <label for="gia_ve" style="display: block; margin: 10px 0 5px; font-weight: bold; color: #333;">Giá vé (VND):</label>
                <input type="number" name="gia_ve" id="gia_ve" required min="0" step="0.01" placeholder="Nhập giá vé" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">

                <label for="tong_cho_ngoi" style="display: block; margin: 10px 0 5px; font-weight: bold; color: #333;">Tổng số chỗ ngồi:</label>
                <input type="number" name="tong_cho_ngoi" id="tong_cho_ngoi" required min="1" placeholder="Nhập số chỗ ngồi" style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">

                <label for="mo_ta_su_kien" style="display: block; margin: 10px 0 5px; font-weight: bold; color: #333;">Mô tả sự kiện:</label>
                <textarea name="mo_ta_su_kien" id="mo_ta_su_kien" placeholder="Mô tả chi tiết sự kiện..." style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ddd; border-radius: 4px; resize: vertical; height: 150px; box-sizing: border-box;"></textarea>

                <label for="logo" style="display: block; margin: 10px 0 5px; font-weight: bold; color: #333;">Logo sự kiện (nếu có):</label>
                <input type="file" name="logo" id="logo" accept="image/*" style="padding: 5px; margin-bottom: 15px; border-radius: 4px; box-sizing: border-box;">

                <label for="background_image" style="display: block; margin: 10px 0 5px; font-weight: bold; color: #333;">Ảnh nền (nếu có):</label>
                <input type="file" name="background_image" id="background_image" accept="image/*" style="padding: 5px; margin-bottom: 15px; border-radius: 4px; box-sizing: border-box;">

                <button type="submit" style="width: 100%; padding: 12px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; font-size: 16px; cursor: pointer; transition: background-color 0.3s ease;">
                    Tạo sự kiện
                </button>
            </form>

            <div style="text-align: center; margin-top: 20px;">
                <p><a href="{{ url('/') }}" style="color: #4CAF50; text-decoration: none;">Quay lại trang chủ</a></p>
            </div>
        </div>
    </div>
                `;
            }
            else if (page === 'events') {
                content = `
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
                <p><strong>Tên sự kiện:</strong> {{ Str::limit($sukien->ten, 100) }}</p>
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
                <a href="{{ route('sukien.show', $sukien->id) }}">
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
                `;
            } 
            else if (page === 'terms') {
                content = `
                 <div class="content" style="width: 80%; margin: 50px auto; background-color: #fff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); font-family: 'Arial', sans-serif; background-color: #f4f4f4; color: #333; line-height: 1.6;">

        <h1 style="color: rgba(255, 105, 180); font-size: 2.5rem; text-align: center;">Điều khoản Ban tổ chức Vé Ca Nhạc</h1>

        <h2 style="color: rgba(30, 144, 255); font-size: 2rem; margin-top: 25px; text-align: center;">1. Quy định về vé và sự kiện</h2>
        <p style="font-size: 1.1rem; text-align: justify; margin-bottom: 20px;">
            Vé ca nhạc là một sản phẩm có giá trị sử dụng cho một sự kiện cụ thể. Mỗi vé chỉ có giá trị đối với sự kiện mà nó được phát hành. Vui lòng kiểm tra kỹ thông tin sự kiện trước khi mua vé.
        </p>

        <h2 style="color: rgba(30, 144, 255); font-size: 2rem; margin-top: 25px; text-align: center;">2. Quyền và nghĩa vụ của Ban tổ chức</h2>
        <p style="font-size: 1.1rem; text-align: justify; margin-bottom: 20px;">
            Ban tổ chức có quyền thay đổi thông tin sự kiện, địa điểm hoặc thời gian tổ chức nếu có lý do bất khả kháng. Chúng tôi cam kết thông báo cho người mua vé trước ít nhất 24 giờ để đảm bảo quyền lợi của người tham gia.
        </p>

        <h2 style="color: rgba(30, 144, 255); font-size: 2rem; margin-top: 25px; text-align: center;">3. Điều khoản về việc hoàn vé</h2>
        <p style="font-size: 1.1rem; text-align: justify; margin-bottom: 20px;">
            Vé sẽ không được hoàn trả trong các trường hợp như người mua không thể tham dự sự kiện hoặc sự kiện được tổ chức đúng theo thông tin đã công bố. Tuy nhiên, trong trường hợp sự kiện bị hủy bỏ bởi lý do từ Ban tổ chức, người mua sẽ được hoàn lại tiền vé đầy đủ.
        </p>

        <h2 style="color: rgba(30, 144, 255); font-size: 2rem; margin-top: 25px; text-align: center;">4. Quy định về hành vi tham gia sự kiện</h2>
        <p style="font-size: 1.1rem; text-align: justify; margin-bottom: 20px;">
            Người tham gia sự kiện phải tuân thủ các quy định của Ban tổ chức, bao gồm việc không mang các vật dụng cấm, gây rối trật tự, hay có hành vi ảnh hưởng đến sự an toàn của các thành viên khác trong sự kiện.
        </p>

        <h2 style="color: rgba(30, 144, 255); font-size: 2rem; margin-top: 25px; text-align: center;">5. Quyền lợi người mua vé</h2>
        <p style="font-size: 1.1rem; text-align: justify; margin-bottom: 20px;">
            Người mua vé sẽ được hưởng quyền lợi về chỗ ngồi ưu tiên (nếu có), quyền tham gia các hoạt động giao lưu đặc biệt, và các ưu đãi khác từ Ban tổ chức tùy theo từng sự kiện cụ thể.
        </p>

        <h2 style="color: rgba(30, 144, 255); font-size: 2rem; margin-top: 25px; text-align: center;">6. Phí dịch vụ và thanh toán</h2>
        <p style="font-size: 1.1rem; text-align: justify; margin-bottom: 20px;">
            Mỗi vé sẽ bao gồm phí dịch vụ, được tính vào tổng giá trị vé. Phí dịch vụ này không được hoàn lại trong bất kỳ trường hợp nào.
        </p>

        <h2 style="color: rgba(30, 144, 255); font-size: 2rem; margin-top: 25px; text-align: center;">7. Liên hệ Ban tổ chức</h2>
        <p style="font-size: 1.1rem; text-align: justify; margin-bottom: 20px;">
            Nếu có bất kỳ thắc mắc nào, vui lòng liên hệ Ban tổ chức qua email <strong>contact@event.com</strong> hoặc số điện thoại <strong>(+84) 123 456 789</strong>.
        </p>

        <div class="footer" style="text-align: center; margin-top: 50px; font-size: 1rem; color: #888;">
            <p><a href="{{ url('/') }}" style="color: rgba(30, 144, 255); text-decoration: none;">Quay lại trang chủ</a></p>
        </div>

    </div>
                
                `;
            } else if (page === 'status') {
                content = `<h1>Trạng thái duyệt sự kiện</h1><p>Thông tin về trạng thái duyệt sự kiện sẽ được hiển thị ở đây.</p>`;
            }
            document.getElementById('content').innerHTML = content;
        }
    </script>

@include('layouts.footer')
</body>
</html>
