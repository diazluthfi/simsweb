<?php

use App\Exports\ProdukExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DataController;
use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Illuminate\Http\Request;

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

Route::get('/', [AuthController::class, 'showlogin']);
Route::post('/', [AuthController::class, 'login'])->name('login');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::middleware('auth')->group(function () {

    Route::get('/index', [AuthController::class, 'showIndex'])->name('showIndex');
    Route::get('/profile', [AuthController::class, 'showProfile'])->name('showProfile');

    Route::prefix('produk')->name('produk.')->group(function () {

        Route::get('/create', [DataController::class, 'showCreate'])->name('showCreate');
        Route::post('/create', [DataController::class, 'create'])->name('create');
        Route::delete('/delete/{id}', [DataController::class, 'delete'])->name('delete');
        Route::get('/edit/{id}', [DataController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DataController::class, 'update'])->name('update');
    });
});

Route::get('/produk/export', function (Request $request) {
    $filters = [
        'search' => $request->search,
        'category_id' => $request->category_id,
    ];

    return Excel::download(new ProdukExport($filters), 'produk.xlsx');
})->name('produk.export');
