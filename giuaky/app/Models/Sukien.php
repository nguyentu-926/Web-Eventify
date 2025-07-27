<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sukien extends Model
{
    use HasFactory;

    protected $table = 'su_kien'; // Đảm bảo trùng với tên bảng trong database

    protected $fillable = [
        'ten', 'ngay', 'dia_diem', 'gia_ve', 
        'tong_cho_ngoi', 'mo_ta_su_kien', 'logo', 
        'background_image', 'the_loai','trang_thai',
    ];

    public $timestamps = false; // Nếu bảng không có created_at, updated_at
}
