<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\frontendController;
use App\Http\Controllers\penyakitController;
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

Route::get('/', [frontendController::class, 'Index'])->name('index');
Route::get('/get-resep', [frontendController::class, 'getResep'])->name('get.resep');
//route::get('result', [penyakitController::class, 'Result']);



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/empiris',[App\Http\Controllers\empirisController::class,'index'])->name('empiris');
Route::view('/addResep', 'addResep')->name('addResep');
Route::get('/daftar-resep',[frontendController::class,'getResep'])->name('resep-default');
Route::get('resep/{id}',[frontendController::class,'detailResep'])->name('detailResep');

Route::post('/bahan', function(Request $request){
    return 'halo';
});
Route::middleware( ['auth','verifiedUser'])->group(function () {
    route::get('form', [frontendController::class, 'Form'])->name('form-resep');
    route::post('submision', [frontendController::class, 'Submision']);
    route::post('result', [penyakitController::class, 'Insert']);
    route::get('history', [penyakitController::class, 'History']);
});

Route::middleware( ['auth','verifiedUser','isAdmin'])->group(function () {
    route::get('bahan', [frontendController::class, 'daftarBahan'])->name('daftar-bahan');
    route::get('users', [frontendController::class, 'Users']);
    route::get('add-resep', [frontendController::class, 'Add']);
    route::post('insert-resep', [frontendController::class, 'Insert']);
    route::get('edit-resep/{id}', [frontendController::class, 'Edit']);
    route::put('update-resep/{id}', [frontendController::class, 'Update']);
    route::get('delete-resep/{id}', [frontendController::class, 'Destroy']);
    route::get('verify-user/{id}', [frontendController::class, 'VerifyUser']);
    route::get('block-user/{id}', [frontendController::class, 'BlockUser']);
});
//API
route::get('api/ingredient', [frontendController::class, 'daftarBahanAPI']);
route::get('api/ingredient/{pk}',[frontendController::class,'detailBahanAPI']);
route::get('api/medicine/{pk}',[frontendController::class, 'detailResepAPI']);
route::get('api/medicine', [frontendController::class, 'getResepAPI']);
