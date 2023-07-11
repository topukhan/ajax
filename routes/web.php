<?php

use App\Http\Controllers\CrudController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');
// CRUD
//Create
Route::get('/create', [CrudController::class, 'createFormView'])->name('createForm');
Route::post('/create', [CrudController::class, 'createFormValidation'])->name('createFormValidation');
//Read All Data
Route::get('/list', [CrudController::class, 'index'])->name('list');
//Edit user data
Route::get('/edit/{id}', [CrudController::class, 'editFormView'])->name('editForm');
Route::patch('/edit', [CrudController::class, 'updateUserInfo'])->name('updateUserInfo');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
