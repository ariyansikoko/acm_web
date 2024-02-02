<?php

use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardProjectController;
use App\Http\Controllers\DashboardTransactionController;
use GuzzleHttp\Middleware;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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
Route::get('/pengeluaran/{transaction:expense_id}', [TransactionController::class, 'show'])->middleware('auth');

Route::get('/proyek', [ProjectController::class, 'index'])->middleware('auth');
Route::get('/proyek/{project:project_id}', [ProjectController::class, 'detail'])->middleware('auth');

Route::get('/penerima', [RecipientController::class, 'index'])->middleware('auth');

Route::get('/about', function () {
    return view('about', [
        'title' => 'ACM | About',
    ]);
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);

Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('auth');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/dashboard', function () {
    return view('dashboard.index', [
        'title' => 'ACM | Dashboard',
    ]);
})->middleware('auth');

Route::resource('/dashboard/pengeluaran', DashboardTransactionController::class)->middleware('auth');
Route::resource('/dashboard/proyek', DashboardProjectController::class)->middleware('auth');
