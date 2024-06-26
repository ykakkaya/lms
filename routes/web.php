<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminSettingsController;
use App\Http\Controllers\Admin\CategoryAdminController;
use App\Http\Controllers\Admin\SubCategoryAdminController;
use App\Http\Controllers\Admin\InstructorAdminController;
use App\Http\Controllers\Instructor\InstructorSettingsController;
use App\Http\Controllers\Frontend\IndexPageController;
use App\Http\Controllers\Frontend\RegisterPageController;
use App\Http\Controllers\Frontend\LoginPageController;


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
//     return view('frontend.index');
// });

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
    //Category Routes
    Route::get('/category/index',[CategoryAdminController::class,'index'])->name('admin.category.index');
    Route::get('/category/create',[CategoryAdminController::class,'create'])->name('admin.category.create');
    Route::post('/category/store',[CategoryAdminController::class,'store'])->name('admin.category.store');
    Route::get('/category/edit/{id}',[CategoryAdminController::class,'edit'])->name('admin.category.edit');
    Route::post('/category/update/{id}',[CategoryAdminController::class,'update'])->name('admin.category.update');
    Route::get('/category/delete/{id}',[CategoryAdminController::class,'destroy'])->name('admin.category.delete');
    //subcategory Routes
    Route::get('/subcategory/index',[SubCategoryAdminController::class,'index'])->name('admin.subcategory.index');
    Route::get('/subcategory/create',[SubCategoryAdminController::class,'create'])->name('admin.subcategory.create');
    Route::post('/subcategory/store',[SubCategoryAdminController::class,'store'])->name('admin.subcategory.store');
    Route::get('/subcategory/edit/{id}',[SubCategoryAdminController::class,'edit'])->name('admin.subcategory.edit');
    Route::post('/subcategory/update/{id}',[SubCategoryAdminController::class,'update'])->name('admin.subcategory.update');
    Route::get('/subcategory/delete/{id}',[SubCategoryAdminController::class,'destroy'])->name('admin.subcategory.delete');
    //admin instructors Routes
    Route::get('/instructor/index',[InstructorAdminController::class,'index'])->name('admin.instructor.index');
    Route::post('/instructor/update/{id}',[InstructorAdminController::class,'update'])->name('admin.instructor.update');
});

//instructor routes
Route::prefix('/instructor')->middleware(['auth','role:instructor'])->group(function(){
    Route::get('/dashboard',[InstructorSettingsController::class,'index'])->name('instructor.index');
    Route::get('/instructor/logout',[InstructorSettingsController::class,'instructorLogout'])->name('instructor.logout');
    Route::get('/user_profile',[InstructorSettingsController::class,'profileShow'])->name('instructor.profile.show');
    Route::post('/profile_update',[InstructorSettingsController::class,'profileUpdate'])->name('instructor.profile.update');
    Route::get('/profile/change/password',[InstructorSettingsController::class,'changePassword'])->name('instructor.profile.changePassword');
    Route::post('/profile/update/password',[InstructorSettingsController::class,'updatePassword'])->name('instructor.profile.updatePassword');
});


//frontend
Route::get('/',[IndexPageController::class,'index'])->name('frontend.index');
Route::get('/login',[LoginPageController::class,'index'])->name('frontend.login');
Route::get('/frontend/logout',[IndexPageController::class,'logout'])->name('frontend.logout');
Route::get('/instructor/register',[RegisterPageController::class,'instructorRegister'])->name('frontend.instructor.register');
Route::post('/instructor/store',[RegisterPageController::class,'instructorStore'])->name('frontend.instructor.store');

require __DIR__.'/auth.php';
