<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\TransactionController;
use App\Http\Livewire\DepositWithdrawal;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::post('/impersonate/{user}', [ImpersonateController::class, 'impersonate'])->name('impersonate.impersonate');

Route::get('/transactions', [TransactionController::class, 'index'])->name('transactions.index');
Route::get('/transactions/deposit', [TransactionController::class, 'deposit'])->name('transactions.deposit');
Route::get('/transactions/withdraw', [TransactionController::class, 'withdraw'])->name('transactions.withdraw');
// Route::post('/transactions', [TransactionController::class, 'store'])->name('transactions.store');

Route::get('/deposit-withdrawal', DepositWithdrawal::class)->name('deposit-withdrawal');
