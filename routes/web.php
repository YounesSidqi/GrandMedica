<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\KasirController;
use App\Http\Controllers\ModalController;
use App\Http\Controllers\PricelistController;
use App\Http\Controllers\ScreenopnameController;
use App\Models\ScreenOpname;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['guest'])->group(function() {
    Route::get('/sign-in', [AuthController::class, 'index'])->name('login'); // Tambahkan nama login
    Route::post('/sign-in', [AuthController::class, 'login'])->name('login.post');
});

Route::get('/home',function(){
    return redirect('/admin_dashboard/screen_opname'); 
});





Route::middleware(['auth'])->group(function(){
//route screen opname
Route::get('/admin_dashboard/screen_opname', [ScreenopnameController::class, 'index'])-> name('screenopname.home');
//route edit
Route::get('/admin_dashboard/screen_opname/edit/{id}', [ScreenopnameController::class, 'edit']);
//route add
Route::get('/admin_dashboard/screen_opname/add', [ScreenopnameController::class, 'create'])->name('screenopname.add');
//route add Stock
Route::get('/admin_dashboard/screen_opname/tambah_stok/{id}',
[ScreenopnameController::class, 'pageStokPemasukan'])->name('screenopname.pagestokpemasukan');
//route Out Stock
Route::get('/admin_dashboard/screen_opname/pengeluaran_stok/{id}',
[ScreenopnameController::class, 'pageStokPengeluaran'])->name('screenopname.pagestokpengeluaran');
//route chart
// Route::get('/admin_dashboard/screen_opname/chart-data/{id}', [ScreenopnameController::class, 'getChartData'])->name('screenopname.chartData');
// Route::get('/admin_dashboard/screen_opname/chart-data/chart-detail/{month}', [ScreenopnameController::class, 'showChartDetail'])->name('screenopname.chartDetail');



//route untuk save data
Route::post('/admin_dashboard/screen_opname/add', [ScreenopnameController::class, 'store'])->name('screenopname.post');

//route update
Route::put('/admin_dashboard/screen_opname/edit/{id}', [ScreenopnameController::class, 'update'])->name('screenopname.update');

//route delete
Route::delete('/admin_dashboard/screen_opname/edit/{id}', [ScreenopnameController::class, 'destroy'])->name('screenopname.delete');

//route tambahStok
Route::put('/admin_dashboard/screenopname/tambah_stok/{id}', [ScreenOpnameController::class, 'tambahStok'])->name('screenopname.addstok');

//route stokKeluar
Route::put('/admin_dashboard/screen_opname/pengeluaran_stok/{id}', [ScreenOpnameController::class, 'stokKeluar'])->name('screenopname.outstok');



//route daftar harga
Route::get('/admin_dashboard/daftar_harga', [PricelistController::class, 'index'])->name('daftarharga.home');
Route::get('/admin_dashboard/daftar_harga/edit/{id}', [PricelistController::class, 'edit'])->name('daftarharga.edit');

Route::put('/admin_dashboard/daftar_harga/edit/{id}', [PricelistController::class, 'update'])->name('daftarharga.update');


// kasir
Route::get('/admin_dashboard/kasir', [KasirController::class, 'index'])->name('kasir.index');
Route::get('/admin_dashboard/kasir/qrcode', [KasirController::class, 'qrcode'])->name('kasir.qrcode');
Route::get('/admin_dashboard/kasir/paymentdone', [KasirController::class, 'paymentdone'])->name('kasir.paymentdone');
Route::get('/admin_dashboard/kasir/printstruk/{id}', [KasirController::class, 'printstruk'])->name('kasir.printstruk');
Route::get('/admin_dashboard/kasir/{id}', [KasirController::class, 'showCart'])->name('modal.detail');
Route::post('/admin_dashboard/kasir/{id}', [KasirController::class, 'storeCart'])->name('modal.addtocart');

//route delete
Route::delete('/admin_dashboard/kasir/{id}', [KasirController::class, 'destroy'])->name('cart.delete');

//payment
Route::post('/admin_dashboard/kasir/payment', [KasirController::class, 'paymentCash'])->name('process.paymentcash');





//logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});


// Route::get('/admin_dashboard/daftar_harga/add', [PricelistController::class, 'create'])->name('daftarharga.add');
//daftar harga start
// Route::post('/admin_dashboard/daftar_harga/add', [PricelistController::class, 'store'])->name('daftarharga.post');




