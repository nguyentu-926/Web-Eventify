<?php
use App\Models\User;
use App\Models\Sukien;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SukienController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VeController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MuaVeController;
use Illuminate\Support\Facades\Session;


// Routes cho sự kiện
Route::get('/sukien/index', [SukienController::class, 'index'])->name('sukien.index');
Route::get('/sukien/create', [SukienController::class, 'create'])->name('sukien.create');
Route::post('/sukien', [SukienController::class, 'store'])->name('sukien.store');
Route::get('/sukien/{id}', [SukienController::class, 'show'])->name('sukien.show');
Route::get('/sukien/{id}/edit', [SukienController::class, 'edit'])->name('sukien.edit');
Route::put('/sukien/{id}', [SukienController::class, 'update'])->name('sukien.update');
Route::delete('/sukien/{id}', [SukienController::class, 'destroy'])->name('sukien.destroy');
Route::middleware('auth')->delete('/sukien/{id}', [SukienController::class, 'destroy'])->name('sukien.destroy');




Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::post('/mua-ve/{id}', [MuaVeController::class, 'muaVe'])->name('mua_ve');
Route::get('/ve-cua-toi', [MuaVeController::class, 'veCuaToi'])->name('ve_cua_toi');





// Trang Admin Dashboard
Route::get('/admin', function () {
    if (!Session::get('is_admin')) {
        return view('admin.login');
    }

    $users = User::all(); // Lấy danh sách người dùng
    $sukien = Sukien::all(); // Lấy danh sách sự kiện

    return view('admin.dashboard', compact('users', 'sukien'));
});

// Xử lý đăng nhập admin
Route::post('giuaky/public/admin-login', function (Request $request) {
    $password = 'admin123'; // Mật khẩu cố định

    if ($request->input('password') === $password) {
        Session::put('is_admin', true);
        return redirect('/admin');
    }

    return back()->with('error', 'Mật khẩu không đúng!');
});

/// Đăng xuất admin
Route::post('/admin/logout', function (Request $request) {
    Session::forget('is_admin');
    return redirect('/admin');
})->name('admin.logout');
Route::put('/sukien/{id}/approve', [SukienController::class, 'approve'])->name('sukien.duyet');
Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('user.destroy');
Route::put('/sukien/duyet-nhieu', [SukienController::class, 'approveMultiple'])->name('sukien.duyetNhieu');

