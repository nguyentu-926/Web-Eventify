<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Sukien;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count(); // Đếm số user
        $totalEvents = Sukien::count(); // Đếm số sự kiện

        return view('admin.dashboard', compact('totalUsers', 'totalEvents'));
    }
}
