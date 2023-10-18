<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\MagangController;
use App\Http\Controllers\AbsensiController;
use App\Http\Controllers\FillPDFController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\ProvinsiController;
use App\Http\Controllers\KecamatanController;
use App\Http\Controllers\KelurahanController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('dashboard.index');
});


Route::get('/kecamatan', [KecamatanController::class, 'index'])->name('kecamatan.index');
Route::get('/kecamatan/update-active/{id}/{active}', [KecamatanController::class, 'updateActive'])->name('kecamatan.update-active');
Route::get('/kecamatan/create', [KecamatanController::class, 'create'])->name('kecamatan.create');
Route::post('/kecamatan/store', [KecamatanController::class, 'store'])->name('kecamatan.store');
Route::get('/kecamatan/edit/{id}', [KecamatanController::class, 'edit'])->name('kecamatan.edit');
Route::post('/kecamatan/update/{id}', [KecamatanController::class, 'update'])->name('kecamatan.update');
Route::get('/kecamatan/delete/{id}', [KecamatanController::class, 'destroy'])->name('kecamatan.delete');


Route::get('/provinsi', [ProvinsiController::class, 'index'])->name('provinsi.index');
Route::get('/provinsi/update-active/{id}/{active}', [ProvinsiController::class, 'updateActive'])->name('provinsi.update-active');
Route::get('/provinsi/create', [ProvinsiController::class, 'create'])->name('provinsi.create');
Route::post('/provinsi/store', [ProvinsiController::class, 'store'])->name('provinsi.store');
Route::get('/provinsi/edit/{id}', [ProvinsiController::class, 'edit'])->name('provinsi.edit');
Route::post('/provinsi/update/{id}', [ProvinsiController::class, 'update'])->name('provinsi.update');
Route::get('/provinsi/delete/{id}', [ProvinsiController::class, 'destroy'])->name('provinsi.delete');


Route::get('/kelurahan', [KelurahanController::class, 'index'])->name('kelurahan.index');
Route::get('/kelurahan/create', [KelurahanController::class, 'create'])->name('kelurahan.create');
Route::post('/kelurahan/store', [KelurahanController::class, 'store'])->name('kelurahan.store');
Route::get('/kelurahan/edit/{id}', [KelurahanController::class, 'edit'])->name('kelurahan.edit');
Route::post('/kelurahan/update/{id}', [KelurahanController::class, 'update'])->name('kelurahan.update');
Route::get('/kelurahan/delete/{id}', [KelurahanController::class, 'destroy'])->name('kelurahan.delete');


Route::get('/pegawai', [PegawaiController::class, 'index'])->name('pegawai.index');
Route::get('/pegawai/create', [PegawaiController::class, 'create'])->name('pegawai.create');
Route::post('/pegawai/store', [PegawaiController::class, 'store'])->name('pegawai.store');
Route::get('/pegawai/edit/{id}', [PegawaiController::class, 'edit'])->name('pegawai.edit');
Route::post('/pegawai/update/{id}', [PegawaiController::class, 'update'])->name('pegawai.update');
Route::get('/pegawai/delete/{id}', [PegawaiController::class, 'destroy'])->name('pegawai.delete');



// Route::resource('absensi', AbsensiController::class)->middleware('auth');
Route::get('/absensi', [AbsensiController::class, 'index'])->name('absensi.index')->middleware('admin');
Route::get('/absensi/{email}', [AbsensiController::class, 'show'])->name('absensi.show')->middleware('auth');
Route::get('/rekapabsensi', [AbsensiController::class, 'index'])->name('rekap.absensi')->middleware('auth');
Route::get('/absensi/create', [AbsensiController::class, 'create'])->name('absensi.create')->middleware('auth');
Route::post('/absensi', [AbsensiController::class, 'store'])->name('absensi.store')->middleware('auth');
Route::get('/absensi/{absensi}/edit', [AbsensiController::class, 'edit'])->name('absensi.edit')->middleware('auth');
Route::put('/absensi/{absensi}', [AbsensiController::class, 'update'])->name('absensi.update')->middleware('auth');
Route::delete('/absensi/{absensi}', [AbsensiController::class, 'destroy'])->name('absensi.destroy')->middleware('admin');
Route::get('/ekspor-pdf', [PdfController::class, 'eksporPDF'])->middleware('auth');
Route::get('/ekspor-pdf/bulan', [PdfController::class, 'eksporPDFBulan'])->middleware('auth');
Route::get('/ekspor-pdf/minggu', [PdfController::class, 'eksporPDFMinggu'])->middleware('auth');
Route::get('/ekspor-pdf/hari', [PdfController::class, 'eksporPDFHari'])->middleware('auth');

Route::get('/users', [UserController::class, 'index'])->name('users.index')->middleware('admin');
Route::get('/users/create', [UserController::class, 'create'])->name('users.create')->middleware('auth');
Route::post('/users', [UserController::class, 'store'])->name('users.store')->middleware('auth');
Route::get('/users/{user}', [UserController::class, 'edit'])->name('users.edit')->middleware('auth');
Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update')->middleware('auth');
Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy')->middleware('admin');

Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [AuthController::class, 'authenticate'])->name('login-post')->middleware('guest');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::get('/register', [AuthController::class, 'register'])->name('register')->middleware('guest');
Route::post('/register', [AuthController::class, 'store'])->name('register-post')->middleware('guest');


Route::get('/approval', [ApprovalController::class, 'index'])->name('approval.index')->middleware('auth');
Route::get('/approver/{i}', [ApprovalController::class, 'approver'])->name('approver.all')->middleware('auth');
Route::get('/approver-edit/{i}/{id}', [ApprovalController::class, 'approverEdit'])->name('approver.edit')->middleware('auth');
Route::get('/approver-show/{i}/{id}', [ApprovalController::class, 'approverShow'])->name('approver.show')->middleware('auth');
Route::post('/approver-store', [ApprovalController::class, 'store'])->name('approver.store')->middleware('auth');
Route::get('/submitted-approval-data', [ApprovalController::class, 'approval'])->name('submitted.approval.data')->middleware('auth');
Route::get('/delete-approval/{id}', [ApprovalController::class, 'destroy'])->name('delete.approval')->middleware('auth');
Route::get('/detail-approval/{id}', [ApprovalController::class, 'show'])->name('detail.approval')->middleware('auth');
Route::get('/edit-approval/{id}', [ApprovalController::class, 'edit'])->name('edit.approval')->middleware('auth');
Route::post('/update-approval/{id}', [ApprovalController::class, 'update'])->name('update.approval')->middleware('auth');
Route::get('/submit-approval/{id}', [ApprovalController::class, 'submit'])->name('submit.approval')->middleware('auth');
Route::get('/create-approval/', [ApprovalController::class, 'create'])->name('create.approval')->middleware('auth');
Route::get('/approver-approval/{id}', [ApprovalController::class, 'approver_approval'])->name('approver.approval')->middleware('auth');
Route::get('/lihat-approval/{id}', [ApprovalController::class, 'lihatApproval'])->name('lihat.approval')->middleware('auth');


Route::get('/responsibility', [ApprovalController::class, 'responsibility'])->name('responsibility.index')->middleware('auth');
Route::get('/responsibility-data', [ApprovalController::class, 'responsibilityData'])->name('responsibility.data')->middleware('auth');

Route::post('/approve-approval', [ApprovalController::class, 'approveApproval'])->name('approve.approval')->middleware('auth');
Route::post('/reject-approval', [ApprovalController::class, 'rejectApproval'])->name('reject.approval')->middleware('auth');