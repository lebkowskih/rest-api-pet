<?php

use App\Http\Controllers\PetController;
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

Route::get('/', [PetController::class, 'index'])->name('pet.index');
Route::post('/pet/store', [PetController::class, 'store'])->name('pet.store');
Route::put('/pet/edit', [PetController::class, 'edit'])->name('pet.edit');
Route::delete('/pet/delete', [PetController::class, 'delete'])->name('pet.delete');
Route::get('/pet/findById', [PetController::class, 'findById'])->name('pet.findById');
