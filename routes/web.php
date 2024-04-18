<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Instructor\InstructorSettingsController;

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
});


//admin routes
Route::prefix('/admin')->middleware(['auth','role:admin'])->group(function(){
    Route::get('/dashboard',[AdminSettingsController::class,'index'])->name('admin.index');
    Route::get('/admin/logout',[AdminSettingsController::class,'adminLogout'])->name('admin.logout');
    Route::get('/user_profile',[AdminSettingsController::class,'profileShow'])->name('admin.profile.show');
    Route::post('/profile_update',[AdminSettingsController::class,'profileUpdate'])->name('admin.profile.update');
    Route::get('/profile/change/password',[AdminSettingsController::class,'changePassword'])->name('admin.profile.changePassword');
    Route::post('/profile/update/password',[AdminSettingsController::class,'updatePassword'])->name('admin.profile.updatePassword');
});

//instructor routes
Route::prefix('/instructor')->middleware(['auth','role:instructor'])->group(function(){
    Route::get('/dashboard',[InstructorSettingsController::class,'index'])->name('instructor.index');
});

require __DIR__.'/auth.php';
