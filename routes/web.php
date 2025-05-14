
<?php

use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//customer management
Route::middleware(['auth'])->group(function () 
{

    Route::get('/list-customer', [App\Http\Controllers\CustomerController::class, 'index'])->name('list_customer');
    Route::get('/add-customer', [App\Http\Controllers\CustomerController::class, 'add_customer'])->name('add_customer');
    Route::post('/store', [App\Http\Controllers\CustomerController::class, 'store'])->name('store');
    Route::get('/history-transactions/{id}', [App\Http\Controllers\CustomerController::class, 'history_transactions'])->name('history_transactions');

});

