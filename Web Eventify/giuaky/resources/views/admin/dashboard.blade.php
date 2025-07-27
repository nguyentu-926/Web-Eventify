<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body { background: #f8f9fa; }
        .sidebar { width: 250px; height: 100vh; background: #343a40; color: white; padding: 20px; position: fixed; }
        .sidebar a { color: white; text-decoration: none; display: block; padding: 10px; border-radius: 5px; }
        .sidebar a:hover { background: #495057; }
        .content { margin-left: 260px; padding: 20px; }
        .stats div { padding: 20px; border-radius: 10px; color: white; font-size: 18px; }
        .users { background: #28a745; }
        .events { background: #17a2b8; }
        table { margin-top: 20px; }
        img { border-radius: 50%; width: 40px; height: 40px; }
    </style>
</head>
<body>
    @if(session('is_admin'))
    <div class="sidebar">
        <h3 class="text-center">Admin Dashboard</h3>
        <a href="#users"><i class="fas fa-users"></i> Quản lý Người Dùng</a>
        <a href="#events"><i class="fas fa-calendar-check"></i> Quản lý Sự Kiện</a>
        <form action="{{ route('admin.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100 mt-3">Đăng xuất</button>
        </form>
    </div>
    <div class="content">
        <div class="container">
            <h2 class="text-center mb-4">Admin Dashboard</h2>
            <div class="row text-center">
                <div class="col-md-6 mb-3">
                    <div class="stats users p-3">
                        🧑‍💼 Tổng số người dùng: {{ count($users) }}
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <div class="stats events p-3">
                        🎟️ Tổng số sự kiện: {{ count($sukien) }}
                    </div>
                </div>
            </div>
            <h3 id="users">Danh sách Người Dùng</h3>
            <table class="table table-bordered table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Avatar</th>
                        <th>Tên</th>
                        <th>Email</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><img src="{{ $user->avatar }}" alt="Avatar"></td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display:inline;">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc muốn xóa tài khoản này?')">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <h3 id="events">Danh sách Sự Kiện</h3>
            <form action="{{ route('sukien.duyetNhieu') }}" method="POST" id="approveForm">
                @csrf @method('PUT')
                <table class="table table-bordered table-hover">
                    <thead class="table-info">
                        <tr>
                            <th>Chọn</th>
                            <th>ID</th>
                            <th>Tên sự kiện</th>
                            <th>Ngày diễn ra</th>
                            <th>Trạng thái</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sukien as $sk)
                        <tr>
                            <td>
                                @if($sk->trang_thai == 'chưa_duyệt')
                                    <input type="checkbox" name="sukien_ids[]" value="{{ $sk->id }}">
                                @endif
                            </td>
                            <td>{{ $sk->id }}</td>
                            <td>{{ $sk->ten }}</td>
                            <td>{{ $sk->ngay }}</td>
                            <td class="fw-bold" 
    @php
        $color = ($sk->trang_thai ?? '') == 'đã duyệt' ? 'green' : 'red';
    @endphp
    style="color: {{ $color }};">
    {{ ($sk->trang_thai ?? '') == 'đã duyệt' ? '✅ Đã duyệt' : '❌ Chưa duyệt' }}
</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-success">Duyệt các sự kiện đã chọn</button>
            </form>
        </div>
    </div>
    @else
    <script>
        alert("Bạn không có quyền truy cập!");
        window.location.href = "{{ url('/admin-login') }}";
    </script>
    @endif
    <script>
        document.getElementById("approveForm").addEventListener("submit", function(e) {
            if (document.querySelectorAll("input[name='sukien_ids[]']:checked").length === 0) {
                alert("Vui lòng chọn ít nhất một sự kiện để duyệt!");
                e.preventDefault();
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>