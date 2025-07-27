<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng ký</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <style>
        body {
            background: rgba(255, 240, 245, 1);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
        }
        .register-container {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }
        h2 {
            color: rgba(255, 105, 180, 1);
        }
        .input-container {
            position: relative;
            margin: 10px 0;
            display: flex;
            align-items: center;
            border: 1px solid rgba(30, 144, 255, 1);
            border-radius: 5px;
            padding: 5px;
            background: white;
        }
        .input-container i {
            color: rgba(255, 105, 180, 1);
            margin-left: 10px;
        }
        .input-container input {
            width: 100%;
            padding: 10px;
            border: none;
            outline: none;
            font-size: 16px;
        }
        button {
            background: rgba(30, 144, 255, 1);
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            font-size: 16px;
        }
        button:hover {
            background: rgba(255, 105, 180, 1);
        }
        .social-buttons {
            margin-top: 15px;
        }
        .social-buttons button {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: white;
            color: black;
            border: 1px solid #ccc;
            width: 100%;
            padding: 10px;
            font-size: 16px;
        }
        .social-buttons button:hover {
            background: #f0f0f0;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Đăng ký tài khoản</h2>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="input-container">
                <i style="color: rgba(255, 105, 180, 1);"  class="fa-solid fa-user"></i>
                <input type="text" name="name" placeholder="Tên" required>
            </div>
            <div class="input-container">
                <i style="color: rgba(255, 105, 180, 1);;" class="fa-solid fa-envelope"></i>
                <input type="email" name="email" placeholder="Email" required>
            </div>
            <div class="input-container">
                <i   style="color: rgba(255, 105, 180, 1);" class="fa-solid fa-lock"></i>
                <input type="password" name="password" placeholder="Mật khẩu" required>
            </div>
            <div class="input-container">
                <i style="color: rgba(255, 105, 180, 1);" class="fa-solid fa-lock"></i>
                <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
            </div>
            <button type="submit">Đăng ký</button>
        </form>
        <div class="social-buttons" >
            <button><i class="fa-brands fa-google"></i> Đăng ký với Google</button>
            <button><i class="fa-brands fa-facebook"></i> Đăng ký với Facebook</button>
        </div>
    </div>
</body>
</html>
