<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
</head>
<style>
    .auth-btn {
    padding-right: 30px;
    padding: 10px 20px;
    font-size: 16px;
    font-weight: 600;
    text-decoration: none;
    border-radius: 25px;
    border: 2px solid rgba(30,144,255, 0.8);
    color: rgba(30,144,255, 0.9);
    transition: all 0.3s ease-in-out;
    background: transparent;
    cursor: pointer;
}

.auth-btn:hover {
    background: rgba(30,144,255, 0.8);
    color: white;
}

.register {
    border-color: rgba(255,105,180, 0.8);
    color: rgba(255,105,180, 0.9);
}

.register:hover {
    background: rgba(255,105,180, 0.8);
    color: white;
}

.logout {
    border-color: #ff4444;
    color: #ff4444;
}

.logout:hover {
    background: #ff4444;
    color: white;
}

</style>
<body>
<header style="background: linear-gradient(0deg, rgba(255,240,245), rgba(255,240,245)); color: white; padding: 20px; text-align: center; box-shadow: 0 0px 0px rgba(0, 0, 0, 0);">
    <div style="display:flex; align-items: center; gap: 20px;padding-left: 80px;">
        <h1 style="margin: 0; font-size: 40px; letter-spacing: 2px;">
            <span style="color: rgba(255,105,180);">A</span><span style="color: rgba(30,144,255);">Ticket</span>
        </h1>
        <div style="position: relative; display: inline-block; border-radius: 50px;">
            <input type="search" placeholder="Tìm kiếm thể loại..." style="padding: 10px 40px 10px 10px; font-size: 16px; width: 400px; border-radius: 5px; border: 1px solid #ccc;">
            <i class="fas fa-search" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); font-size: 18px; color: #888;"></i>
        </div>
        <p style="font-family: 'Poppins', sans-serif; font-size: 20px; font-weight: 600; color: rgba(30,144,255); text-transform: uppercase; letter-spacing: 1px; line-height: 1.5;">
            Đặt vé, bùng nổ cùng sự kiện!
        </p>
        <nav style="display: flex; gap: 15px; align-items: center; margin-left: auto;">
    @guest
        <a href="{{ route('login') }}" class="auth-btn">Đăng nhập</a>
        <a href="{{ route('register') }}" class="auth-btn register">Đăng ký</a>
    @else
        <a href="/profile" class="auth-btn">Tài khoản</a>
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="auth-btn logout">Đăng xuất</button>
        </form>
    @endguest
</nav>

    </div>
</header>
</body>
</html>
