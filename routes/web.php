<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BankController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [BankController::class, 'showDashboard'])
    ->middleware(['auth'])
    ->name('dashboard');
Route::get('/deposite', function () {
    return view('deposite');
})->middleware(['auth'])->name('deposite');

Route::get('/withdraw', function () {
    return view('withdraw');
})->middleware(['auth'])->name('withdraw');

Route::get('/transfer', function () {
    return view('transfer');
})->middleware(['auth'])->name('transfer');

Route::middleware(['auth'])->group(function () {
    Route::get('/statement', [BankController::class, 'showstatement'])->name('statement');
});
Route::post('/deposits', [BankController::class, 'deposit'])->name('deposit');
Route::post('/withdraws', [BankController::class, 'withdrawamount'])->name('withdrawamount');
Route::post('/transfermoney', [BankController::class, 'transferamount'])->name('transferamount');

require __DIR__.'/auth.php';
