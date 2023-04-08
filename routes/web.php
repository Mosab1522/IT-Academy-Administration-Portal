<?php

use App\Http\Controllers\AcademyController;
use App\Http\Controllers\AkademieController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\CourseTypeController;
use App\Http\Controllers\PrihlaskyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TypkurzuController;
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

Route::get('admin/applications',[ApplicationController::class,'index'])->name('admin.applications.index');
Route::get('/',[ApplicationController::class,'create']); 
Route::post('/',[ApplicationController::class,'store']); 

Route::get('admin/academies',[AcademyController::class,'index']);
Route::get('admin/academies/create',[AcademyController::class,'create']); 
Route::get('admin/academies/{academy:id}', [AcademyController::class, 'show']);
Route::post('admin/academies/create',[AcademyController::class,'store']); 

Route::get('admin/coursetypes',[CourseTypeController::class,'index']);
Route::get('admin/coursetypes/create',[CourseTypeController::class,'create']); 
Route::post('admin/coursetypes/create',[CourseTypeController::class,'store']); 

Route::get('admin/students',[StudentController::class,'index']);






Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
