<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\IconProjectController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\DashboardProjectController;
use App\Http\Controllers\DashboardEmployeeController;
use App\Http\Controllers\DashboardRecipientController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\IconTransactionController;
use App\Models\IconTransaction;

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
    return view('index', [
        'title' => 'ACM | Home',
    ]);
});

Route::get('/pengeluaran', [TransactionController::class, 'index'])->middleware('auth');

Route::get('/proyek', [ProjectController::class, 'index'])->middleware('auth');
Route::get('/proyek/{project:project_id}', [ProjectController::class, 'summary'])->middleware('auth');
Route::get('/proyek/{project:project_id}/export', [ProjectController::class, 'export'])->middleware('auth');
Route::post('/proyek/{project:project_id}/create', [ProjectController::class, 'storeTransaction'])->middleware('auth');

Route::get('/laporan/TA', [ReportController::class, 'indexTA'])->middleware('auth');
Route::get('/laporan/Icon', [ReportController::class, 'indexIcon'])->middleware('auth');

Route::get('/about', function () {
    return view('about', [
        'title' => 'ACM | About',
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'index'])->middleware('is_admin');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'title' => 'ACM | Dashboard',
    ]);
})->middleware('auth');

//ICON
Route::resource('/icon/proyek', IconProjectController::class)->middleware('auth');
Route::get('/icon/proyek/{proyek}/transaksi/create', [IconTransactionController::class, 'create'])->name('icon_transaction.create')->middleware('auth');
Route::get('/icon/proyek/{proyek}/transaksi/{transaksi}', [IconTransactionController::class, 'show'])->name('icon_transaction.show')->middleware('auth');
Route::get('/icon/proyek/{proyek}/transaksi/{transaksi}/edit', [IconTransactionController::class, 'edit'])->name('icon_transaction.edit')->middleware('auth');
Route::put('/icon/proyek/{proyek}/transaksi/{transaksi}', [IconTransactionController::class, 'update'])->name('icon_transaction.update')->middleware('auth');
Route::post('/icon/proyek/{proyek}/transaksi', [IconTransactionController::class, 'store'])->name('icon_transaction.store')->middleware('auth');
Route::delete('/icon/proyek/{proyek}/transaksi/{transaksi}', [IconTransactionController::class, 'destroy'])->name('icon_transaction.destroy')->middleware('auth');

//Telkom Akses
Route::resource('/dashboard/pengeluaran', DashboardTransactionController::class)->middleware('auth');
Route::resource('/dashboard/proyek', DashboardProjectController::class)->middleware('auth');
Route::resource('/dashboard/penerima', DashboardRecipientController::class)->except('show')->middleware('auth');

//Admin
Route::resource('/dashboard/account', AdminAccountController::class)->except(['show', 'create', 'store'])->middleware('is_admin');

//HRD TA
Route::resource('/dashboard/karyawan', DashboardEmployeeController::class)->middleware('is_hrd');
Route::get('/dashboard/karyawanNonaktif', [DashboardEmployeeController::class, 'quit'])->middleware('is_hrd');
Route::get('/dashboard/karyawan/{karyawan:id}/editStatus', [DashboardEmployeeController::class, 'editStatus'])->middleware('is_hrd');
Route::get('/dashboard/karyawan/{karyawan:id}/export', [DashboardEmployeeController::class, 'export'])->middleware('is_hrd');
