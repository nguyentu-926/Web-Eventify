<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; background: #f8f9fa; }
        .container { max-width: 300px; margin: auto; background: white; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        input, button { width: 100%; padding: 10px; margin: 10px 0; }
        button { background: #007bff; color: white; border: none; cursor: pointer; }
        .error { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Đăng nhập Admin</h2>
        @if(session('error'))
            <p class="error">{{ session('error') }}</p>
        @endif
        <form method="POST" action="giuaky/public/admin-login">
            @csrf
            <input type="password" name="password" placeholder="Nhập mật khẩu admin" required>
            <button type="submit">Đăng nhập</button>
        </form>
    </div>
</body>
</html>
