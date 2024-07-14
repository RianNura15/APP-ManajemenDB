<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DatabaseController;

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

Route::get('/index', function () {
    return view('data');
});

Route::get('/tambah-data', function () {
    return view('tambahdata');
});

Route::get('/data-column', function () {
    return view('datacolumn');
});

Route::get('/data', [DatabaseController::class, 'index']);
Route::post('/tambah-data', [DatabaseController::class, 'tambahData']);
Route::put('/edit-data/{id}', [DatabaseController::class, 'updateData']);
Route::delete('/delete-data/{id}', [DatabaseController::class, 'deleteData']);
Route::post('/change-column-type', [DatabaseController::class, 'changeColumnType']);
Route::post('/add-primary-key', [DatabaseController::class, 'addPrimaryKey']);
Route::post('/add-auto-increment', [DatabaseController::class, 'addAutoIncrement']);
Route::post('/delete-auto-increment', [DatabaseController::class, 'deleteAutoIncrement']);
Route::post('/allow-null', [DatabaseController::class, 'allowNull']);
Route::post('/disallow-null', [DatabaseController::class, 'disallowNull']);
Route::post('/change-primary-key', [DatabaseController::class, 'changePrimaryKey']);
Route::post('/change-foreign-key', [DatabaseController::class, 'changeForeignKey']);
Route::post('/create-table', [DatabaseController::class, 'createTable']);
Route::get('/form-tambah', [DatabaseController::class, 'indexTambah']);
Route::post('/data-columns', [DatabaseController::class, 'getDataColumn']);
