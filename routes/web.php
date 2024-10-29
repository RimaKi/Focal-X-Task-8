<?php

use App\Http\Controllers\ProfileController;
use App\Mail\PendingTaskMail;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TaskController;
use \App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class,'home']);

Route::get('/dashboard', [TaskController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('/tasks',TaskController::class)->except(['index','show']);
    Route::post('tasks/{task}/toggle', [TaskController::class, 'toggleStatus'])->name('tasks.toggle');


});

require __DIR__.'/auth.php';



