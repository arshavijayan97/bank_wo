<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/account', [AccountController::class, 'index'])->name('account');

    Route::get('/deposit', [AccountController::class, 'showDepositForm'])->name('deposit.form');
    Route::post('/deposit', [AccountController::class, 'deposit'])->name('deposit');

    Route::get('/withdrawal', [AccountController::class, 'showWithdrawalForm'])->name('withdrawal.form');
    Route::post('/withdrawal', [AccountController::class, 'withdrawal'])->name('withdrawal');

    Route::get('/transfer', [AccountController::class, 'showTransferForm'])->name('transfer.form');
    Route::post('/transfer', [AccountController::class, 'transfer'])->name('transfer');

    Route::get('/statement', [AccountController::class, 'showStatement'])->name('statement');

});

require __DIR__.'/auth.php';
