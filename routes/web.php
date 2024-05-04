<?php

use App\Http\Controllers\AcademyController;
use App\Http\Controllers\AkademieController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Class_StudentController;
use App\Http\Controllers\CourseClassController;
use App\Http\Controllers\CourseType_InstructorController;
use App\Http\Controllers\CourseTypeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\LessonController;

use App\Http\Controllers\LessonStudentsController;
use App\Http\Controllers\PrihlaskyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TypkurzuController;
use App\Mail\ConfirmationMail;
use App\Models\Application;
use App\Models\CourseClass;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;


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

//Route for mailing
Route::get('/email', function () {
   // Mail::to('simonka.szlamkova1@gmail.com')->send(new ConfirmationMail());
    return new ConfirmationMail();
});


Route::get('/application/verify/{token}', [ApplicationController::class, 'verify'])->name('application.verify');

Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');

Route::get('admin/calendar', [DashboardController::class, 'calendar'])->name('admin.calendar.index');

Route::get('admin/email', [DashboardController::class, 'email'])->name('admin.dashboard.email');

Route::post('admin/email', [DashboardController::class, 'send'])->name('admin.dashboard.send');

Route::get('/lessons/all', [LessonController::class, 'all']);


Route::get('admin/applications', [ApplicationController::class, 'index'])->name('admin.applications.index');


Route::get('/', [ApplicationController::class, 'create']);
Route::post('/', [ApplicationController::class, 'store']);

Route::get('admin/applications/create', [ApplicationController::class, 'admincreate'])->name('applications');
// Route::get('admin/applications/{application:id}', [ApplicationController::class, 'show']);
Route::delete('admin/applications/{application}', [ApplicationController::class, 'destroy']);






Route::get('admin/academies', [AcademyController::class, 'index'])
    ->name('admin.academies.index');
Route::patch('admin/academies/{academy}', [AcademyController::class, 'update']);
Route::get('admin/academies/create', [AcademyController::class, 'create']);
Route::get('admin/academies/{academy:id}', [AcademyController::class, 'show'])->name('academies.show');
Route::post('admin/academies/create', [AcademyController::class, 'store']);
Route::delete('admin/academies/{academy}', [AcademyController::class, 'destroy']);


Route::get('admin/coursetypes', [CourseTypeController::class, 'index'])->name('admin.coursetypes.index');

Route::get('admin/coursetypes/create', [CourseTypeController::class, 'create']);

Route::patch('admin/coursetypes/{coursetype}', [CoursetypeController::class, 'update']);
Route::get('admin/coursetypes/{coursetype:id}', [CourseTypeController::class, 'show']);
Route::post('admin/coursetypes/create', [CourseTypeController::class, 'store']);
Route::delete('admin/coursetypes/{coursetype}', [CourseTypeController::class, 'destroy']);

Route::post('admin/coursetype_instructor', [CourseType_InstructorController::class, 'store']);
Route::delete('admin/coursetype_instructor/{instructor}/{coursetype}', [CourseType_InstructorController::class, 'destroy'])->name('your.route.name');
// Route::delete('admin/coursetype_instructor/{instructor}', [CourseType_InstructorController::class, 'destroy']);

Route::get('admin/students', [StudentController::class, 'index'])->name('admin.students.index');
Route::patch('admin/students/{student}', [StudentController::class, 'update']);
Route::get('admin/students/create', [StudentController::class, 'create']);
Route::get('admin/students/{student:id}', [StudentController::class, 'show']);

Route::post('admin/students/create', [StudentController::class, 'store']);
Route::get('/search-students', [StudentController::class, 'search'])->name('search-students');
Route::delete('admin/students/{student}', [StudentController::class, 'destroy']);


Route::get('admin/instructors', [InstructorController::class, 'index'])->name('admin.instructors.index');
Route::patch('admin/instructors/{instructor}', [InstructorController::class, 'update']);


Route::get('admin/instructors/create', [InstructorController::class, 'create']);
Route::get('admin/instructors/{instructor:id}', [InstructorController::class, 'show']);
Route::post('admin/instructors/create', [InstructorController::class, 'store']);
Route::delete('admin/instructors/{instructor}', [InstructorController::class, 'destroy']);


Route::get('/instructors/{instructor}/lessons', [InstructorController::class, 'lessonsForInstructor']);

Route::get('admin/classes/select-instructor', [CourseClassController::class, 'selectInstructor'])->name('classes.instructor.select');

Route::get('admin/classes', [CourseClassController::class, 'index'])->name('admin.classes.index');
Route::patch('admin/classes/{class}', [CourseClassController::class, 'update']);
Route::patch('admin/class/end/{class}', [CourseClassController::class, 'end']);




Route::get('admin/classes/create', [CourseClassController::class, 'create']);
Route::get('admin/classes/{class:id}', [CourseClassController::class, 'show']);
Route::post('admin/classes/create', [CourseClassController::class, 'store']);
Route::delete('admin/classes/{class}', [CourseClassController::class, 'destroy']);

Route::post('admin/class-instructor', [CourseClassController::class, 'addinstructor']);



Route::get('admin/lessons', [LessonController::class, 'index'])->name('admin.lessons.index');
Route::patch('admin/lessons/{lesson}', [LessonController::class, 'update']);

Route::get('admin/lessons/create', [LessonController::class, 'create']);
Route::get('admin/lessons/{lesson:id}', [LessonController::class, 'show']);
Route::post('admin/lessons/create', [LessonController::class, 'store']);
Route::delete('admin/lessons/{lesson}', [LessonController::class, 'destroy']);




Route::post('admin/class-student', [Class_StudentController::class, 'store']);
Route::delete('admin/class-student/{student}/{class}', [Class_StudentController::class, 'destroy']);

Route::post('admin/lesson-students', [LessonStudentsController::class, 'store']);
Route::delete('admin/lesson-students/{student}/{lesson}', [LessonStudentsController::class, 'destroy']);

Route::get('admin/reset', [NewPasswordController::class, 'create']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
