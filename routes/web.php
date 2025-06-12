<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\dang_nhap\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\tintuc\SukienController;
use App\Http\Controllers\tintuc\ThongBaoController;

use App\Http\Controllers\thanhtra\KeHoachController;
use App\Http\Controllers\thanhtra\QuyTrinhQuyDinhController;
use App\Http\Controllers\thanhtra\VanBanBieuMauController;

use App\Http\Controllers\phapche\congtacphapcheController;
USE App\Http\Controllers\phapche\CongTacTiepCongDanController;
USE App\Http\Controllers\phapche\CongTacTuyentruyenController;

USE App\Http\Controllers\sohuutritue\ShttQuyTrinhQuyDinhController;
use App\Http\Controllers\sohuutritue\ShttVanBanBieuMauController;
use App\Http\Controllers\sohuutritue\ShttKeHoachCongVanController;

use App\Http\Controllers\vanbanquyphamphapluat\VanBanKhacController;
use App\Http\Controllers\vanbanquyphamphapluat\VanBanPhapCheController;
use App\Http\Controllers\vanbanquyphamphapluat\VanBanSoHuuTriTueController;
use App\Http\Controllers\vanbanquyphamphapluat\VanBanThanhTraController;

use App\Http\Controllers\vanbanDHQG\DHQGvanbanthanhtraController;
use App\Http\Controllers\vanbanDHQG\DHQGVanBanPhapCheController;
use App\Http\Controllers\vanbanDHQG\DHQGVanBanKhacController;
use App\Http\Controllers\vanbanDHQG\DHQGVanBanSoHuuTriTueController;



use App\Http\Controllers\SearchController;


//ROUTE TRANG CHU
Route::get('/',[HomeController::class, 'index']);

//KIEM TRA DANG NHAP ADMIN

Route::get("/admin", function () {
        if (session()->has('admin_logged_in')) {
            return redirect('/admin/welcome');
        } elseif (session()->has('user_logged_out')) {
            return redirect('/user/welcome');
        }
        return redirect('admin/login');
});

Route::get('/admin/login', [AdminController::class, 'showLoginForm'])->name('admin.login');
Route::post('/admin/login', [AdminController::class, 'login'])->name('admin.login.submit');



    // Xác thực đăng nhập admin
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/admin/welcome', [AdminController::class, 'welcome'])->name('admin.welcome');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});
Route::middleware(['user.auth'])->group(function () {
    Route::get('/user/welcome', [AdminController::class, 'welcome'])->name('user.welcome');
    Route::post('/user/logout', [AdminController::class, 'logout'])->name('user.logout');
});


//CURD USER

Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/user/index', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('admin.user.create');
    Route::post('/user', [UserController::class, 'store'])->name('admin.user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
    Route::put('/user/{id}', [UserController::class, 'update'])->name('admin.user.update');
    
    // Sửa thành DELETE cho route xóa
    Route::delete('/user/{id}', [UserController::class, 'destroy'])->name('admin.user.destroy');
});
//CURD TIN TUC ADMIM
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/sukien/index', [SukienController::class, 'index'])->name('admin.sukien.index');
    Route::get('/sukien/create', [SukienController::class, 'create'])->name('admin.sukien.create');
    Route::post('/sukien', [SukienController::class, 'store'])->name('admin.sukien.store');
    Route::get('/sukien/{id}/edit', [SukienController::class, 'edit'])->name('admin.sukien.edit');
    Route::put('/sukien/{id}', [SukienController::class, 'update'])->name('admin.sukien.update');
    Route::delete('/sukien/{id}', [SukienController::class, 'destroy'])->name('admin.sukien.destroy');
});
//CURD TIN TUC USER
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/sukien/index', [SukienController::class, 'index'])->name('user.sukien.index');
    Route::get('/sukien/create', [SukienController::class, 'create'])->name('user.sukien.create');
    Route::post('/sukien', [SukienController::class, 'store'])->name('user.sukien.store');
    Route::get('/sukien/{id}/edit', [SukienController::class, 'edit'])->name('user.sukien.edit');
    Route::put('/sukien/{id}', [SukienController::class, 'update'])->name('user.sukien.update');
    Route::delete('/sukien/{id}', [SukienController::class, 'destroy'])->name('user.sukien.destroy');
});


//CURD THONG BAO admin
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/thongbao/index', [ThongBaoController::class, 'index'])->name('admin.thongbao.index');
    Route::get('/thongbao/create', [ThongBaoController::class, 'create'])->name('admin.thongbao.create');
    Route::post('/thongbao', [ThongBaoController::class, 'store'])->name('admin.thongbao.store');
    Route::get('/thongbao/{id}/edit', [ThongBaoController::class, 'edit'])->name('admin.thongbao.edit');
    Route::put('/thongbao/{id}', [ThongBaoController::class, 'update'])->name('admin.thongbao.update');
    Route::delete('/thongbao/{id}', [ThongBaoController::class, 'destroy'])->name('admin.thongbao.destroy');
});
//CRud thong bao user
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/thongbao/index', [ThongBaoController::class, 'index'])->name('user.thongbao.index');
    Route::get('/thongbao/create', [ThongBaoController::class, 'create'])->name('user.thongbao.create');
    Route::post('/thongbao', [ThongBaoController::class, 'store'])->name('user.thongbao.store');
    Route::get('/thongbao/{id}/edit', [ThongBaoController::class, 'edit'])->name('user.thongbao.edit');
    Route::put('/thongbao/{id}', [ThongBaoController::class, 'update'])->name('user.thongbao.update');
    Route::delete('/thongbao/{id}', [ThongBaoController::class, 'destroy'])->name('user.thongbao.destroy');
});
//curd so huu tri tue quy trinh quy dinh
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/shttquytrinh/index', [ShttQuyTrinhQuyDinhController::class, 'index'])->name('admin.shttquytrinh.index');
    Route::get('/shttquytrinh/create', [ShttQuyTrinhQuyDinhController::class, 'create'])->name('admin.shttquytrinh.create');
    Route::post('/shttquytrinh', [ShttQuyTrinhQuyDinhController::class, 'store'])->name('admin.shttquytrinh.store');
    Route::get('/shttquytrinh/{id}/edit', [ShttQuyTrinhQuyDinhController::class, 'edit'])->name('admin.shttquytrinh.edit');
    Route::put('/shttquytrinh/{id}', [ShttQuyTrinhQuyDinhController::class, 'update'])->name('admin.shttquytrinh.update');
    Route::delete('/shttquytrinh/{id}', [ShttQuyTrinhQuyDinhController::class, 'destroy'])->name('admin.shttquytrinh.destroy');
});
//CURD QUY TRINH QUY DINH 


// CRUD Quy trình - Quy định
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/quytrinhquydinh/index', [QuyTrinhQuyDinhController::class, 'index'])->name('admin.quytrinhquydinh.index');
    Route::get('/quytrinhquydinh/create', [QuyTrinhQuyDinhController::class, 'create'])->name('admin.quytrinhquydinh.create');
    Route::post('/quytrinhquydinh', [QuyTrinhQuyDinhController::class, 'store'])->name('admin.quytrinhquydinh.store');
    Route::get('/quytrinhquydinh/{id}/edit', [QuyTrinhQuyDinhController::class, 'edit'])->name('admin.quytrinhquydinh.edit');
    Route::put('/quytrinhquydinh/{id}', [QuyTrinhQuyDinhController::class, 'update'])->name('admin.quytrinhquydinh.update');
    Route::delete('/quytrinhquydinh/{id}', [QuyTrinhQuyDinhController::class, 'destroy'])->name('admin.quytrinhquydinh.destroy');
});

//CUrd van ban bieu mau
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/vanbanbieumau/index', [VanBanBieuMauController::class, 'index'])->name('admin.vanbanbieumau.index');
    Route::get('/vanbanbieumau/create', [VanBanBieuMauController::class, 'create'])->name('admin.vanbanbieumau.create');
    Route::post('/vanbanbieumau', [VanBanBieuMauController::class, 'store'])->name('admin.vanbanbieumau.store');
    Route::get('/vanbanbieumau/{id}/edit', [VanBanBieuMauController::class, 'edit'])->name('admin.vanbanbieumau.edit');
    Route::put('/vanbanbieumau/{id}', [VanBanBieuMauController::class, 'update'])->name('admin.vanbanbieumau.update');
    Route::delete('/vanbanbieumau/{id}', [VanBanBieuMauController::class, 'destroy'])->name('admin.vanbanbieumau.destroy');
});

//CRUD ke hoach
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/kehoach/index', [KeHoachController::class, 'index'])->name('admin.kehoach.index');
    Route::get('/kehoach/create', [KeHoachController::class, 'create'])->name('admin.kehoach.create');
    Route::post('/kehoach', [KeHoachController::class, 'store'])->name('admin.kehoach.store');
    Route::get('/kehoach/{id}/edit', [KeHoachController::class, 'edit'])->name('admin.kehoach.edit');
    Route::put('/kehoach/{id}', [KeHoachController::class, 'update'])->name('admin.kehoach.update');
    Route::delete('/kehoach/{id}', [KeHoachController::class, 'destroy'])->name('admin.kehoach.destroy');
});
//CRUD ke hoach cho nguoi dung
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/thanhtra/index', [KeHoachController::class, 'index'])->name('user.thanhtra.kehoach.index');
    Route::get('/thantra/create', [KeHoachController::class, 'create'])->name('user.thanhtra.kehoach.create');
    Route::post('/thanhtra', [KeHoachController::class, 'store'])->name('user.thanhtra.kehoach.store');
    Route::get('/thanhtra/{id}/edit', [KeHoachController::class, 'edit'])->name('user.thanhtra.kehoach.edit');
    Route::put('/thanhtra/{id}', [KeHoachController::class, 'update'])->name('user.thanhtra.kehoach.update');
    Route::delete('/thanhtra/{id}', [KeHoachController::class, 'destroy'])->name('user.thanhtra.kehoach.destroy');
});

// CRUD cong tac phap che
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/congtacphapche/index', [CongTacPhapCheController::class, 'index'])->name('admin.congtacphapche.index');
    Route::get('/congtacphapche/create', [CongTacPhapCheController::class, 'create'])->name('admin.congtacphapche.create');
    Route::post('/congtacphapche', [CongTacPhapCheController::class, 'store'])->name('admin.congtacphapche.store');
    Route::get('/congtacphapche/{id}/edit', [CongTacPhapCheController::class, 'edit'])->name('admin.congtacphapche.edit');
    Route::put('/congtacphapche/{id}', [CongTacPhapCheController::class, 'update'])->name('admin.congtacphapche.update');
    Route::delete('/congtacphapche/{id}', [CongTacPhapCheController::class, 'destroy'])->name('admin.congtacphapche.destroy');
});
//CRUD cong tac tiep cong dan
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/congtactiepcongdan/index', [CongTacTiepCongDanController::class, 'index'])->name('admin.congtactiepcongdan.index');
    Route::get('/congtactiepcongdan/create', [CongTacTiepCongDanController::class, 'create'])->name('admin.congtactiepcongdan.create');
    Route::post('/congtactiepcongdan', [CongTacTiepCongDanController::class, 'store'])->name('admin.congtactiepcongdan.store');
    Route::get('/congtactiepcongdan/{id}/edit', [CongTacTiepCongDanController::class, 'edit'])->name('admin.congtactiepcongdan.edit');
    Route::put('/congtactiepcongdan/{id}', [CongTacTiepCongDanController::class, 'update'])->name('admin.congtactiepcongdan.update');
    Route::delete('/congtactiepcongdan/{id}', [CongTacTiepCongDanController::class, 'destroy'])->name('admin.congtactiepcongdan.destroy');
});
//CRUD cong tac tuyen truyen pho bien phap luat
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/congtactuyentruyenphobienphapluat/index', [CongTacTuyentruyenController::class, 'index'])->name('admin.congtactuyentruyenphobienphapluat.index');
    Route::get('/congtactuyentruyenphobienphapluat/create', [CongTacTuyentruyenController::class, 'create'])->name('admin.congtactuyentruyenphobienphapluat.create');
    Route::post('/congtactuyentruyenphobienphapluat', [CongTacTuyentruyenController::class, 'store'])->name('admin.congtactuyentruyenphobienphapluat.store');
    Route::get('/congtactuyentruyenphobienphapluat/{id}/edit', [CongTacTuyentruyenController::class, 'edit'])->name('admin.congtactuyentruyenphobienphapluat.edit');
    Route::put('/congtactuyentruyenphobienphapluat/{id}', [CongTacTuyentruyenController::class, 'update'])->name('admin.congtactuyentruyenphobienphapluat.update');
    Route::delete('/congtactuyentruyenphobienphapluat/{id}', [CongTacTuyentruyenController::class, 'destroy'])->name('admin.congtactuyentruyenphobienphapluat.destroy');
});
//CRUD Shttvanbanbieumau
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/shttvanbanbieumau/index', [ShttVanBanBieuMauController::class, 'index'])->name('admin.shttvanbanbieumau.index');
    Route::get('/shttvanbanbieumau/create', [ShttVanBanBieuMauController::class, 'create'])->name('admin.shttvanbanbieumau.create');
    Route::post('/shttvanbanbieumau', [ShttVanBanBieuMauController::class, 'store'])->name('admin.shttvanbanbieumau.store');
    Route::get('/shttvanbanbieumau/{id}/edit', [ShttVanBanBieuMauController::class, 'edit'])->name('admin.shttvanbanbieumau.edit');
    Route::put('/shttvanbanbieumau/{id}', [ShttVanBanBieuMauController::class, 'update'])->name('admin.shttvanbanbieumau.update');
    Route::delete('/shttvanbanbieumau/{id}', [ShttVanBanBieuMauController::class, 'destroy'])->name('admin.shttvanbanbieumau.destroy');
});
//CRUD ShttKeHoachCongVan
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/shttkehoachcongvan/index', [ShttKeHoachCongVanController::class, 'index'])->name('admin.shttkehoachcongvan.index');
    Route::get('/shttkehoachcongvan/create', [ShttKeHoachCongVanController::class, 'create'])->name('admin.shttkehoachcongvan.create');
    Route::post('/shttkehoachcongvan', [ShttKeHoachCongVanController::class, 'store'])->name('admin.shttkehoachcongvan.store');
    Route::get('/shttkehoachcongvan/{id}/edit', [ShttKeHoachCongVanController::class, 'edit'])->name('admin.shttkehoachcongvan.edit');
    Route::put('/shttkehoachcongvan/{id}', [ShttKeHoachCongVanController::class, 'update'])->name('admin.shttkehoachcongvan.update');
    Route::delete('/shttkehoachcongvan/{id}', [ShttKeHoachCongVanController::class, 'destroy'])->name('admin.shttkehoachcongvan.destroy');
});
//vanbanquyphamphapluat
//CRUD VanBanKhac
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/vanbankhac/index', [VanBanKhacController::class, 'index'])->name('admin.vanbankhac.index');
    Route::get('/vanbankhac/create', [VanBanKhacController::class, 'create'])->name('admin.vanbankhac.create');
    Route::post('/vanbankhac', [VanBanKhacController::class, 'store'])->name('admin.vanbankhac.store');
    Route::get('/vanbankhac/{id}/edit', [VanBanKhacController::class, 'edit'])->name('admin.vanbankhac.edit');
    Route::put('/vanbankhac/{id}', [VanBanKhacController::class, 'update'])->name('admin.vanbankhac.update');
    Route::delete('/vanbankhac/{id}', [VanBanKhacController::class, 'destroy'])->name('admin.vanbankhac.destroy');
});
//CRUD VanBanPhapChe
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/vanbanphapche/index', [VanBanPhapCheController::class, 'index'])->name('admin.vanbanphapche.index');
    Route::get('/vanbanphapche/create', [VanBanPhapCheController::class, 'create'])->name('admin.vanbanphapche.create');
    Route::post('/vanbanphapche', [VanBanPhapCheController::class, 'store'])->name('admin.vanbanphapche.store');
    Route::get('/vanbanphapche/{id}/edit', [VanBanPhapCheController::class, 'edit'])->name('admin.vanbanphapche.edit');
    Route::put('/vanbanphapche/{id}', [VanBanPhapCheController::class, 'update'])->name('admin.vanbanphapche.update');
    Route::delete('/vanbanphapche/{id}', [VanBanPhapCheController::class, 'destroy'])->name('admin.vanbanphapche.destroy');
});
//CRUD VanBanSoHuuTriTue
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/vanbansohuutritue/index', [VanBanSoHuuTriTueController::class, 'index'])->name('admin.vanbansohuutritue.index');
    Route::get('/vanbansohuutritue/create', [VanBanSoHuuTriTueController::class, 'create'])->name('admin.vanbansohuutritue.create');
    Route::post('/vanbansohuutritue', [VanBanSoHuuTriTueController::class, 'store'])->name('admin.vanbansohuutritue.store');
    Route::get('/vanbansohuutritue/{id}/edit', [VanBanSoHuuTriTueController::class, 'edit'])->name('admin.vanbansohuutritue.edit');
    Route::put('/vanbansohuutritue/{id}', [VanBanSoHuuTriTueController::class, 'update'])->name('admin.vanbansohuutritue.update');
    Route::delete('/vanbansohuutritue/{id}', [VanBanSoHuuTriTueController::class, 'destroy'])->name('admin.vanbansohuutritue.destroy');
});
//CRUD VanBanThanhTra
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/vanbanthanhtra/index', [VanBanThanhTraController::class, 'index'])->name('admin.vanbanthanhtra.index');
    Route::get('/vanbanthanhtra/create', [VanBanThanhTraController::class, 'create'])->name('admin.vanbanthanhtra.create');
    Route::post('/vanbanthanhtra', [VanBanThanhTraController::class, 'store'])->name('admin.vanbanthanhtra.store');
    Route::get('/vanbanthanhtra/{id}/edit', [VanBanThanhTraController::class, 'edit'])->name('admin.vanbanthanhtra.edit');
    Route::put('/vanbanthanhtra/{id}', [VanBanThanhTraController::class, 'update'])->name('admin.vanbanthanhtra.update');
    Route::delete('/vanbanthanhtra/{id}', [VanBanThanhTraController::class, 'destroy'])->name('admin.vanbanthanhtra.destroy');
});
//VanBanDHQG
//CRUD dhqgvanbanthanhtra
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/dhqgvanbanthanhtra/index', [DHQGvanbanthanhtraController::class, 'index'])->name('admin.dhqgvanbanthanhtra.index');
    Route::get('/dhqgvanbanthanhtra/create', [DHQGvanbanthanhtraController::class, 'create'])->name('admin.dhqgvanbanthanhtra.create');
    Route::post('/dhqgvanbanthanhtra', [DHQGvanbanthanhtraController::class, 'store'])->name('admin.dhqgvanbanthanhtra.store');
    Route::get('/dhqgvanbanthanhtra/{id}/edit', [DHQGvanbanthanhtraController::class, 'edit'])->name('admin.dhqgvanbanthanhtra.edit');
    Route::put('/dhqgvanbanthanhtra/{id}', [DHQGvanbanthanhtraController::class, 'update'])->name('admin.dhqgvanbanthanhtra.update');
    Route::delete('/dhqgvanbanthanhtra/{id}', [DHQGvanbanthanhtraController::class, 'destroy'])->name('admin.dhqgvanbanthanhtra.destroy');
});
//CRUD dhqgvanbanphapche
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/dhqgvanbanphapche/index', [DHQGVanBanPhapCheController::class, 'index'])->name('admin.dhqgvanbanphapche.index');
    Route::get('/dhqgvanbanphapche/create', [DHQGVanBanPhapCheController::class, 'create'])->name('admin.dhqgvanbanphapche.create');
    Route::post('/dhqgvanbanphapche', [DHQGVanBanPhapCheController::class, 'store'])->name('admin.dhqgvanbanphapche.store');
    Route::get('/dhqgvanbanphapche/{id}/edit', [DHQGVanBanPhapCheController::class, 'edit'])->name('admin.dhqgvanbanphapche.edit');
    Route::put('/dhqgvanbanphapche/{id}', [DHQGVanBanPhapCheController::class, 'update'])->name('admin.dhqgvanbanphapche.update');
    Route::delete('/dhqgvanbanphapche/{id}', [DHQGVanBanPhapCheController::class, 'destroy'])->name('admin.dhqgvanbanphapche.destroy');
});
//CRUD dhqgvanbansohuutritue
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/dhqgvanbansohuutritue/index', [DHQGVanBanSoHuuTriTueController::class, 'index'])->name('admin.dhqgvanbansohuutritue.index');
    Route::get('/dhqgvanbansohuutritue/create', [DHQGVanBanSoHuuTriTueController::class, 'create'])->name('admin.dhqgvanbansohuutritue.create');
    Route::post('/dhqgvanbansohuutritue', [DHQGVanBanSoHuuTriTueController::class, 'store'])->name('admin.dhqgvanbansohuutritue.store');
    Route::get('/dhqgvanbansohuutritue/{id}/edit', [DHQGVanBanSoHuuTriTueController::class, 'edit'])->name('admin.dhqgvanbansohuutritue.edit');
    Route::put('/dhqgvanbansohuutritue/{id}', [DHQGVanBanSoHuuTriTueController::class, 'update'])->name('admin.dhqgvanbansohuutritue.update');
    Route::delete('/dhqgvanbansohuutritue/{id}', [DHQGVanBanSoHuuTriTueController::class, 'destroy'])->name('admin.dhqgvanbansohuutritue.destroy');
});
//CRUD dhqgvanbankhac
Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/dhqgvanbankhac/index', [DHQGVanBanKhacController::class, 'index'])->name('admin.dhqgvanbankhac.index');
    Route::get('/dhqgvanbankhac/create', [DHQGVanBanKhacController::class, 'create'])->name('admin.dhqgvanbankhac.create');
    Route::post('/dhqgvanbankhac', [DHQGVanBanKhacController::class, 'store'])->name('admin.dhqgvanbankhac.store');
    Route::get('/dhqgvanbankhac/{id}/edit', [DHQGVanBanKhacController::class, 'edit'])->name('admin.dhqgvanbankhac.edit');
    Route::put('/dhqgvanbankhac/{id}', [DHQGVanBanKhacController::class, 'update'])->name('admin.dhqgvanbankhac.update');
    Route::delete('/dhqgvanbankhac/{id}', [DHQGVanBanKhacController::class, 'destroy'])->name('admin.dhqgvanbankhac.destroy');
});
// ROUTES

//curd so huu tri tue quy trinh quy dinh
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/shttquytrinh/index', [ShttQuyTrinhQuyDinhController::class, 'index'])->name('user.shttquytrinh.index');
    Route::get('/shttquytrinh/create', [ShttQuyTrinhQuyDinhController::class, 'create'])->name('user.shttquytrinh.create');
    Route::post('/shttquytrinh', [ShttQuyTrinhQuyDinhController::class, 'store'])->name('user.shttquytrinh.store');
    Route::get('/shttquytrinh/{id}/edit', [ShttQuyTrinhQuyDinhController::class, 'edit'])->name('user.shttquytrinh.edit');
    Route::put('/shttquytrinh/{id}', [ShttQuyTrinhQuyDinhController::class, 'update'])->name('user.shttquytrinh.update');
    Route::delete('/shttquytrinh/{id}', [ShttQuyTrinhQuyDinhController::class, 'destroy'])->name('user.shttquytrinh.destroy');
});
//CURD QUY TRINH QUY DINH 


//  CRUD user  Quy trình - Quy định
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/quytrinhquydinh/index', [QuyTrinhQuyDinhController::class, 'index'])->name('user.quytrinhquydinh.index');
    Route::get('/quytrinhquydinh/create', [QuyTrinhQuyDinhController::class, 'create'])->name('user.quytrinhquydinh.create');
    Route::post('/quytrinhquydinh', [QuyTrinhQuyDinhController::class, 'store'])->name('user.quytrinhquydinh.store');
    Route::get('/quytrinhquydinh/{id}/edit', [QuyTrinhQuyDinhController::class, 'edit'])->name('user.quytrinhquydinh.edit');
    Route::put('/quytrinhquydinh/{id}', [QuyTrinhQuyDinhController::class, 'update'])->name('user.quytrinhquydinh.update');
    Route::delete('/quytrinhquydinh/{id}', [QuyTrinhQuyDinhController::class, 'destroy'])->name('user.quytrinhquydinh.destroy');
});

//CUrd van ban bieu mau
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/vanbanbieumau/index', [VanBanBieuMauController::class, 'index'])->name('user.vanbanbieumau.index');
    Route::get('/vanbanbieumau/create', [VanBanBieuMauController::class, 'create'])->name('user.vanbanbieumau.create');
    Route::post('/vanbanbieumau', [VanBanBieuMauController::class, 'store'])->name('user.vanbanbieumau.store');
    Route::get('/vanbanbieumau/{id}/edit', [VanBanBieuMauController::class, 'edit'])->name('user.vanbanbieumau.edit');
    Route::put('/vanbanbieumau/{id}', [VanBanBieuMauController::class, 'update'])->name('user.vanbanbieumau.update');
    Route::delete('/vanbanbieumau/{id}', [VanBanBieuMauController::class, 'destroy'])->name('user.vanbanbieumau.destroy');
});

// CRUD user  ke hoach
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/kehoach/index', [KeHoachController::class, 'index'])->name('user.kehoach.index');
    Route::get('/kehoach/create', [KeHoachController::class, 'create'])->name('user.kehoach.create');
    Route::post('/kehoach', [KeHoachController::class, 'store'])->name('user.kehoach.store');
    Route::get('/kehoach/{id}/edit', [KeHoachController::class, 'edit'])->name('user.kehoach.edit');
    Route::put('/kehoach/{id}', [KeHoachController::class, 'update'])->name('user.kehoach.update');
    Route::delete('/kehoach/{id}', [KeHoachController::class, 'destroy'])->name('user.kehoach.destroy');
});
// CRUD user  ke hoach cho nguoi dung
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/thanhtra/index', [KeHoachController::class, 'index'])->name('user.thanhtra.kehoach.index');
    Route::get('/thantra/create', [KeHoachController::class, 'create'])->name('user.thanhtra.kehoach.create');
    Route::post('/thanhtra', [KeHoachController::class, 'store'])->name('user.thanhtra.kehoach.store');
    Route::get('/thanhtra/{id}/edit', [KeHoachController::class, 'edit'])->name('user.thanhtra.kehoach.edit');
    Route::put('/thanhtra/{id}', [KeHoachController::class, 'update'])->name('user.thanhtra.kehoach.update');
    Route::delete('/thanhtra/{id}', [KeHoachController::class, 'destroy'])->name('user.thanhtra.kehoach.destroy');
});

//  CRUD user  cong tac phap che
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/congtacphapche/index', [CongTacPhapCheController::class, 'index'])->name('user.congtacphapche.index');
    Route::get('/congtacphapche/create', [CongTacPhapCheController::class, 'create'])->name('user.congtacphapche.create');
    Route::post('/congtacphapche', [CongTacPhapCheController::class, 'store'])->name('user.congtacphapche.store');
    Route::get('/congtacphapche/{id}/edit', [CongTacPhapCheController::class, 'edit'])->name('user.congtacphapche.edit');
    Route::put('/congtacphapche/{id}', [CongTacPhapCheController::class, 'update'])->name('user.congtacphapche.update');
    Route::delete('/congtacphapche/{id}', [CongTacPhapCheController::class, 'destroy'])->name('user.congtacphapche.destroy');
});
// CRUD user  cong tac tiep cong dan
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/congtactiepcongdan/index', [CongTacTiepCongDanController::class, 'index'])->name('user.congtactiepcongdan.index');
    Route::get('/congtactiepcongdan/create', [CongTacTiepCongDanController::class, 'create'])->name('user.congtactiepcongdan.create');
    Route::post('/congtactiepcongdan', [CongTacTiepCongDanController::class, 'store'])->name('user.congtactiepcongdan.store');
    Route::get('/congtactiepcongdan/{id}/edit', [CongTacTiepCongDanController::class, 'edit'])->name('user.congtactiepcongdan.edit');
    Route::put('/congtactiepcongdan/{id}', [CongTacTiepCongDanController::class, 'update'])->name('user.congtactiepcongdan.update');
    Route::delete('/congtactiepcongdan/{id}', [CongTacTiepCongDanController::class, 'destroy'])->name('user.congtactiepcongdan.destroy');
});
// CRUD user  cong tac tuyen truyen pho bien phap luat
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/congtactuyentruyenphobienphapluat/index', [CongTacTuyentruyenController::class, 'index'])->name('user.congtactuyentruyenphobienphapluat.index');
    Route::get('/congtactuyentruyenphobienphapluat/create', [CongTacTuyentruyenController::class, 'create'])->name('user.congtactuyentruyenphobienphapluat.create');
    Route::post('/congtactuyentruyenphobienphapluat', [CongTacTuyentruyenController::class, 'store'])->name('user.congtactuyentruyenphobienphapluat.store');
    Route::get('/congtactuyentruyenphobienphapluat/{id}/edit', [CongTacTuyentruyenController::class, 'edit'])->name('user.congtactuyentruyenphobienphapluat.edit');
    Route::put('/congtactuyentruyenphobienphapluat/{id}', [CongTacTuyentruyenController::class, 'update'])->name('user.congtactuyentruyenphobienphapluat.update');
    Route::delete('/congtactuyentruyenphobienphapluat/{id}', [CongTacTuyentruyenController::class, 'destroy'])->name('user.congtactuyentruyenphobienphapluat.destroy');
});
// CRUD user  Shttvanbanbieumau
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/shttvanbanbieumau/index', [ShttVanBanBieuMauController::class, 'index'])->name('user.shttvanbanbieumau.index');
    Route::get('/shttvanbanbieumau/create', [ShttVanBanBieuMauController::class, 'create'])->name('user.shttvanbanbieumau.create');
    Route::post('/shttvanbanbieumau', [ShttVanBanBieuMauController::class, 'store'])->name('user.shttvanbanbieumau.store');
    Route::get('/shttvanbanbieumau/{id}/edit', [ShttVanBanBieuMauController::class, 'edit'])->name('user.shttvanbanbieumau.edit');
    Route::put('/shttvanbanbieumau/{id}', [ShttVanBanBieuMauController::class, 'update'])->name('user.shttvanbanbieumau.update');
    Route::delete('/shttvanbanbieumau/{id}', [ShttVanBanBieuMauController::class, 'destroy'])->name('user.shttvanbanbieumau.destroy');
});
// CRUD user  ShttKeHoachCongVan
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/shttkehoachcongvan/index', [ShttKeHoachCongVanController::class, 'index'])->name('user.shttkehoachcongvan.index');
    Route::get('/shttkehoachcongvan/create', [ShttKeHoachCongVanController::class, 'create'])->name('user.shttkehoachcongvan.create');
    Route::post('/shttkehoachcongvan', [ShttKeHoachCongVanController::class, 'store'])->name('user.shttkehoachcongvan.store');
    Route::get('/shttkehoachcongvan/{id}/edit', [ShttKeHoachCongVanController::class, 'edit'])->name('user.shttkehoachcongvan.edit');
    Route::put('/shttkehoachcongvan/{id}', [ShttKeHoachCongVanController::class, 'update'])->name('user.shttkehoachcongvan.update');
    Route::delete('/shttkehoachcongvan/{id}', [ShttKeHoachCongVanController::class, 'destroy'])->name('user.shttkehoachcongvan.destroy');
});
//vanbanquyphamphapluat
// CRUD user  VanBanKhac
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/vanbankhac/index', [VanBanKhacController::class, 'index'])->name('user.vanbankhac.index');
    Route::get('/vanbankhac/create', [VanBanKhacController::class, 'create'])->name('user.vanbankhac.create');
    Route::post('/vanbankhac', [VanBanKhacController::class, 'store'])->name('user.vanbankhac.store');
    Route::get('/vanbankhac/{id}/edit', [VanBanKhacController::class, 'edit'])->name('user.vanbankhac.edit');
    Route::put('/vanbankhac/{id}', [VanBanKhacController::class, 'update'])->name('user.vanbankhac.update');
    Route::delete('/vanbankhac/{id}', [VanBanKhacController::class, 'destroy'])->name('user.vanbankhac.destroy');
});
// CRUD user  VanBanPhapChe
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/vanbanphapche/index', [VanBanPhapCheController::class, 'index'])->name('user.vanbanphapche.index');
    Route::get('/vanbanphapche/create', [VanBanPhapCheController::class, 'create'])->name('user.vanbanphapche.create');
    Route::post('/vanbanphapche', [VanBanPhapCheController::class, 'store'])->name('user.vanbanphapche.store');
    Route::get('/vanbanphapche/{id}/edit', [VanBanPhapCheController::class, 'edit'])->name('user.vanbanphapche.edit');
    Route::put('/vanbanphapche/{id}', [VanBanPhapCheController::class, 'update'])->name('user.vanbanphapche.update');
    Route::delete('/vanbanphapche/{id}', [VanBanPhapCheController::class, 'destroy'])->name('user.vanbanphapche.destroy');
});
// CRUD user  VanBanSoHuuTriTue
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/vanbansohuutritue/index', [VanBanSoHuuTriTueController::class, 'index'])->name('user.vanbansohuutritue.index');
    Route::get('/vanbansohuutritue/create', [VanBanSoHuuTriTueController::class, 'create'])->name('user.vanbansohuutritue.create');
    Route::post('/vanbansohuutritue', [VanBanSoHuuTriTueController::class, 'store'])->name('user.vanbansohuutritue.store');
    Route::get('/vanbansohuutritue/{id}/edit', [VanBanSoHuuTriTueController::class, 'edit'])->name('user.vanbansohuutritue.edit');
    Route::put('/vanbansohuutritue/{id}', [VanBanSoHuuTriTueController::class, 'update'])->name('user.vanbansohuutritue.update');
    Route::delete('/vanbansohuutritue/{id}', [VanBanSoHuuTriTueController::class, 'destroy'])->name('user.vanbansohuutritue.destroy');
});
// CRUD user  VanBanThanhTra
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/vanbanthanhtra/index', [VanBanThanhTraController::class, 'index'])->name('user.vanbanthanhtra.index');
    Route::get('/vanbanthanhtra/create', [VanBanThanhTraController::class, 'create'])->name('user.vanbanthanhtra.create');
    Route::post('/vanbanthanhtra', [VanBanThanhTraController::class, 'store'])->name('user.vanbanthanhtra.store');
    Route::get('/vanbanthanhtra/{id}/edit', [VanBanThanhTraController::class, 'edit'])->name('user.vanbanthanhtra.edit');
    Route::put('/vanbanthanhtra/{id}', [VanBanThanhTraController::class, 'update'])->name('user.vanbanthanhtra.update');
    Route::delete('/vanbanthanhtra/{id}', [VanBanThanhTraController::class, 'destroy'])->name('user.vanbanthanhtra.destroy');
});
//VanBanDHQG
// CRUD user  dhqgvanbanthanhtra
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/dhqgvanbanthanhtra/index', [DHQGvanbanthanhtraController::class, 'index'])->name('user.dhqgvanbanthanhtra.index');
    Route::get('/dhqgvanbanthanhtra/create', [DHQGvanbanthanhtraController::class, 'create'])->name('user.dhqgvanbanthanhtra.create');
    Route::post('/dhqgvanbanthanhtra', [DHQGvanbanthanhtraController::class, 'store'])->name('user.dhqgvanbanthanhtra.store');
    Route::get('/dhqgvanbanthanhtra/{id}/edit', [DHQGvanbanthanhtraController::class, 'edit'])->name('user.dhqgvanbanthanhtra.edit');
    Route::put('/dhqgvanbanthanhtra/{id}', [DHQGvanbanthanhtraController::class, 'update'])->name('user.dhqgvanbanthanhtra.update');
    Route::delete('/dhqgvanbanthanhtra/{id}', [DHQGvanbanthanhtraController::class, 'destroy'])->name('user.dhqgvanbanthanhtra.destroy');
});
// CRUD user  dhqgvanbanphapche
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/dhqgvanbanphapche/index', [DHQGVanBanPhapCheController::class, 'index'])->name('user.dhqgvanbanphapche.index');
    Route::get('/dhqgvanbanphapche/create', [DHQGVanBanPhapCheController::class, 'create'])->name('user.dhqgvanbanphapche.create');
    Route::post('/dhqgvanbanphapche', [DHQGVanBanPhapCheController::class, 'store'])->name('user.dhqgvanbanphapche.store');
    Route::get('/dhqgvanbanphapche/{id}/edit', [DHQGVanBanPhapCheController::class, 'edit'])->name('user.dhqgvanbanphapche.edit');
    Route::put('/dhqgvanbanphapche/{id}', [DHQGVanBanPhapCheController::class, 'update'])->name('user.dhqgvanbanphapche.update');
    Route::delete('/dhqgvanbanphapche/{id}', [DHQGVanBanPhapCheController::class, 'destroy'])->name('user.dhqgvanbanphapche.destroy');
});
// CRUD user  dhqgvanbansohuutritue
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/dhqgvanbansohuutritue/index', [DHQGVanBanSoHuuTriTueController::class, 'index'])->name('user.dhqgvanbansohuutritue.index');
    Route::get('/dhqgvanbansohuutritue/create', [DHQGVanBanSoHuuTriTueController::class, 'create'])->name('user.dhqgvanbansohuutritue.create');
    Route::post('/dhqgvanbansohuutritue', [DHQGVanBanSoHuuTriTueController::class, 'store'])->name('user.dhqgvanbansohuutritue.store');
    Route::get('/dhqgvanbansohuutritue/{id}/edit', [DHQGVanBanSoHuuTriTueController::class, 'edit'])->name('user.dhqgvanbansohuutritue.edit');
    Route::put('/dhqgvanbansohuutritue/{id}', [DHQGVanBanSoHuuTriTueController::class, 'update'])->name('user.dhqgvanbansohuutritue.update');
    Route::delete('/dhqgvanbansohuutritue/{id}', [DHQGVanBanSoHuuTriTueController::class, 'destroy'])->name('user.dhqgvanbansohuutritue.destroy');
});
// CRUD user  dhqgvanbankhac
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/dhqgvanbankhac/index', [DHQGVanBanKhacController::class, 'index'])->name('user.dhqgvanbankhac.index');
    Route::get('/dhqgvanbankhac/create', [DHQGVanBanKhacController::class, 'create'])->name('user.dhqgvanbankhac.create');
    Route::post('/dhqgvanbankhac', [DHQGVanBanKhacController::class, 'store'])->name('user.dhqgvanbankhac.store');
    Route::get('/dhqgvanbankhac/{id}/edit', [DHQGVanBanKhacController::class, 'edit'])->name('user.dhqgvanbankhac.edit');
    Route::put('/dhqgvanbankhac/{id}', [DHQGVanBanKhacController::class, 'update'])->name('user.dhqgvanbankhac.update');
    Route::delete('/dhqgvanbankhac/{id}', [DHQGVanBanKhacController::class, 'destroy'])->name('user.dhqgvanbankhac.destroy');
});
//Route::delete('/admin/sukien/{id}', [SukienController::class, 'destroy'])->name('admin.sukien.destroy');
//show trang và cả show chi tiết
//trang chu
//thongbao
Route::get('/tin-tuc/show-thongbao/{id}', [ThongBaoController::class, 'show'])->name('trang-chu.tin-tuc.show-thongbao');
Route::get('/tin-tuc/thong-bao', [ThongBaoController::class, 'showM'])->name('trang-chu.tin-tuc.thong-bao');
//thanhtra
Route::get('/thanh-tra/van-ban-bieu-mau', [VanBanBieuMauController::class, 'showM'])->name('trang-chu.thanh-tra.van-ban-bieu-mau');
Route::get('/thanh-tra/show-bieumau/{id}', [VanBanBieuMauController::class, 'show'])->name('trang-chu.thanh-tra.show-bieumau');
Route::get('/thanh-tra/show-thanhtra/{id}', [QuyTrinhQuyDinhController::class, 'show'])->name('trang-chu.thanh-tra.show-thanhtra');
Route::get('/thanh-tra/quy-trinh-quy-dinh', [QuyTrinhQuyDinhController::class, 'showM'])->name('trang-chu.thanh-tra.quy-trinh-quy-dinh');
Route::get('/thanh-tra/show-kehoach/{id}', [KeHoachController::class, 'show'])->name('trang-chu.thanh-tra.show-kehoach');
Route::get('/thanh-tra/ke-hoach', [KeHoachController::class, 'showM'])->name('trang-chu.thanh-tra.ke-hoach');
//tintuc
Route::get('/tin-tuc/show-Sukien/{id}', [SukienController::class, 'show'])->name('trang-chu.tin-tuc.show-Sukien');
Route::get('/tin-tuc/su-kien', [SukienController::class, 'showcard']);

//phapche
Route::get('/phap-che/show-congtacphapche/{id}', [CongTacPhapCheController::class, 'show'])->name('trang-chu.phap-che.show-congtacphapche');
Route::get('/phap-che/cong-tac-phap-che', [CongTacPhapCheController::class, 'showM'])->name('trang-chu.phap-che.cong-tac-phap-che');
Route::get('/phap-che/show-congtactiepcongdan/{id}', [CongTacTiepCongDanController::class, 'show'])->name('trang-chu.phap-che.show-congtactiepcongdan');
Route::get('/phap-che/cong-tac-tiep-cong-dan', [CongTacTiepCongDanController::class, 'showM'])->name('trang-chu.phap-che.cong-tac-tiep-cong-dan');
Route::get('/phap-che/show-congtactuyentruyenphobienphapluat/{id}', [CongTacTuyentruyenController::class, 'show'])->name('trang-chu.phap-che.show-congtactuyentruyenphobienphapluat');
Route::get('/phap-che/cong-tac-tuyen-truyen-pho-bien-phap-luat', [CongTacTuyentruyenController::class, 'showM'])->name('trang-chu.phap-che.cong-tac-tuyen-truyen-pho-bien-phap-luat');


//so huu tri tue
Route::get('/so-huu-tri-tue/show-shttquytrinh/{id}', [ShttQuyTrinhQuyDinhController::class, 'show'])->name('trang-chu.so-huu-tri-tue.show-shttquytrinh');
Route::get('/so-huu-tri-tue/shtt-quy-trinh-quy-dinh', [ShttQuyTrinhQuyDinhController::class, 'showM'])->name('trang-chu.so-huu-tri-tue.shtt-quy-trinh-quy-dinh');
Route::get('/so-huu-tri-tue/show-shttvanbanbieumau/{id}', [ShttVanBanBieuMauController::class, 'show'])->name('trang-chu.so-huu-tri-tue.show-shttvanbanbieumau');
Route::get('/so-huu-tri-tue/shtt-van-ban-bieu-mau', [ShttVanBanBieuMauController::class, 'showM'])->name('trang-chu.so-huu-tri-tue.shtt-van-ban-bieu-mau');
Route::get('/so-huu-tri-tue/show-shttkehoachcongvan/{id}', [ShttKeHoachCongVanController::class, 'show'])->name('trang-chu.so-huu-tri-tue.show-shttkehoachcongvan');
Route::get('/so-huu-tri-tue/shtt-ke-hoach-cong-van', [ShttKeHoachCongVanController::class, 'showM'])->name('trang-chu.so-huu-tri-tue.shtt-ke-hoach-cong-van');

Route::middleware(['admin.auth'])->prefix('admin')->group(function () {
    Route::get('/{group}/{page}', [AdminController::class, 'pages_admin'])->name('admin.pages_admin');
});
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/{group}/{page}', [AdminController::class, 'pages_user'])->name('user.pages_user');
});
//van ban quy pham phap luat
Route::get('/van-ban-quy-pham-phap-luat/show-vanbankhac/{id}', [VanBanKhacController::class, 'show'])->name('trang-chu.van-ban-quy-pham-phap-luat.show-vanbankhac');
Route::get('/van-ban-quy-pham-phap-luat/van-ban-khac', [VanBanKhacController::class, 'showM'])->name('trang-chu.van-ban-quy-pham-phap-luat.van-ban-khac');
Route::get('/van-ban-quy-pham-phap-luat/show-vanbanphapche/{id}', [VanBanPhapCheController::class, 'show'])->name('trang-chu.van-ban-quy-pham-phap-luat.show-vanbanphapche');
Route::get('/van-ban-quy-pham-phap-luat/van-ban-phap-che', [VanBanPhapCheController::class, 'showM'])->name('trang-chu.van-ban-quy-pham-phap-luat.van-ban-phap-che');
Route::get('/van-ban-quy-pham-phap-luat/show-vanbansohuutritue/{id}', [VanBanSoHuuTriTueController::class, 'show'])->name('trang-chu.van-ban-quy-pham-phap-luat.show-vanbansohuutritue');
Route::get('/van-ban-quy-pham-phap-luat/van-ban-so-huu-tri-tue', [VanBanSoHuuTriTueController::class, 'showM'])->name('trang-chu.van-ban-quy-pham-phap-luat.van-ban-so-huu-tri-tue');
Route::get('/van-ban-quy-pham-phap-luat/show-vanbanthanhtra/{id}', [VanBanThanhTraController::class, 'show'])->name('trang-chu.van-ban-quy-pham-phap-luat.show-vanbanthanhtra');
Route::get('/van-ban-quy-pham-phap-luat/van-ban-thanh-tra', [VanBanThanhTraController::class, 'showM'])->name('trang-chu.van-ban-quy-pham-phap-luat.van-ban-thanh-tra');

//van ban dhqg
Route::get('/van-ban-dhqg/show-dhqgvanbanthanhtra/{id}', [DHQGvanbanthanhtraController::class, 'show'])->name('trang-chu.van-ban-dhqg.show-dhqgvanbanthanhtra');
Route::get('/van-ban-dhqg/dhqg-van-ban-thanh-tra', [DHQGvanbanthanhtraController::class, 'showM'])->name('trang-chu.van-ban-dhqg.dhqg-van-ban-thanh-tra');
Route::get('/van-ban-dhqg/show-dhqgvanbanphapche/{id}', [DHQGVanBanPhapCheController::class, 'show'])->name('trang-chu.van-ban-dhqg.show-dhqgvanbanphapche');
Route::get('/van-ban-dhqg/dhqg-van-ban-phap-che', [DHQGVanBanPhapCheController::class, 'showM'])->name('trang-chu.van-ban-dhqg.dhqg-van-ban-phap-che');
Route::get('/van-ban-dhqg/show-dhqgvanbansohuutritue/{id}', [DHQGVanBanSoHuuTriTueController::class, 'show'])->name('trang-chu.van-ban-dhqg.show-dhqgvanbansohuutritue');
Route::get('/van-ban-dhqg/dhqg-van-ban-so-huu-tri-tue', [DHQGVanBanSoHuuTriTueController::class, 'showM'])->name('trang-chu.van-ban-dhqg.dhqg-van-ban-so-huu-tri-tue');
Route::get('/van-ban-dhqg/show-dhqgvanbankhac/{id}', [DHQGVanBanKhacController::class, 'show'])->name('trang-chu.van-ban-dhqg.show-dhqgvanbankhac');
Route::get('/van-ban-dhqg/dhqg-van-ban-khac', [DHQGVanBanKhacController::class, 'showM'])->name('trang-chu.van-ban-dhqg.dhqg-van-ban-khac');


//tim kiem
Route::get('/tim-kiem', [SearchController::class, 'index'])->name('trang-chu.tim-kiem.ket-qua');
Route::middleware(['user.auth'])->prefix('user')->group(function () {
    Route::get('/{group}/{page}', [AdminController::class, 'pages_user'])->name('user.pages_user');
});


Route::get('/{group}/{page}', [HomeController::class, 'pages'])->name('trang-chu.pages');

Route::get('/check-mongo', function () {
    try {
        $databases = DB::connection('mongodb')->getMongoClient()->listDatabases();
        return response()->json(['status' => '✅ MongoDB kết nối thành công!', 'databases' => $databases]);
    } catch (\Exception $e) {
        return response()->json(['status' => '❌ Kết nối MongoDB thất bại', 'error' => $e->getMessage()]);
    }
});
// xử lý ảnh ckeditor tải ảnh lên 
// routes/web.php hoặc routes/admin.php

use App\Http\Controllers\CKEditorUploadController; // Tạo controller này ở bước sau

Route::post('/admin/ckeditor-upload-image', [CKEditorUploadController::class, 'upload'])->name('admin.ckeditor.upload_image')->middleware('auth'); // Bảo vệ route bằng middleware auth



