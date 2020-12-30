<?php

use App\Http\Controllers\userscontroller;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\InstructorsController;
use App\Http\Controllers\iconsController;
use App\Http\Controllers\SafetytipsController;
use App\Http\Controllers\DiscussionsController;
use Illuminate\Support\Facades\Route;
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
    return view('index');
});
Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware(['auth']);

//users crud and role

Route::get('/logout', [userscontroller::class, 'logout']);
Route::get('/loginpage', [userscontroller::class, 'loginpage']);
Route::post('/loginuser', [userscontroller::class, 'loginuser']);
Route::post('/registeruser', [userscontroller::class, 'registeruser']);
Route::get('/registerpage', [userscontroller::class, 'registerpage']);
Route::get('/forgetpassword', [userscontroller::class, 'forgetpassword']);
Route::post('/setpassword', [userscontroller::class, 'setpassword']);
Route::get('/resetpassword', [userscontroller::class, 'resetpassword']);
Route::get('/edit/{id}', [userscontroller::class, 'edit']);
Route::post('/update/{id}', [userscontroller::class, 'update']);


//course crud

Route::get('/course/{cat}', [CourseController::class, 'course_wise_url']);

Route::get('/course', [CourseController::class, 'course'])->name('courses');
Route::get('/courses', [CourseController::class, 'coursecreate']);
Route::post('/createcourse', [CourseController::class, 'coursestore']);
Route::get('/course/replicate/{id}',  [CourseController::class, 'course_replicate']);
Route::get('/course/edit/{id}',  [CourseController::class, 'course_edit']);
Route::post('/course/update/{id}',  [CourseController::class, 'course_update']);
Route::post('/course/delete',  [CourseController::class, 'destroy']);

//students crud

Route::get('/students', [StudentsController::class, 'students'])->name('students');
Route::get('/studentcreate', [StudentsController::class, 'create']);
Route::post('/studentstore', [StudentsController::class, 'store']);
Route::get('/student/edit/{id}',  [StudentsController::class, 'edit']);
Route::post('/student/update/{id}',  [StudentsController::class, 'update']);
Route::post('/student/delete',  [StudentsController::class, 'destroy']);

//School crud

Route::get('/schools', [SchoolsController::class, 'schools'])->name('school');
Route::get('/schoolcreate', [SchoolsController::class, 'create']);
Route::post('/schoolstore', [SchoolsController::class, 'store']);
Route::get('/school/edit/{id}',  [SchoolsController::class, 'edit']);
Route::post('/school/update/{id}',  [SchoolsController::class, 'update']);
Route::post('/school/delete',  [SchoolsController::class, 'destroy']);


//Routes for Instructors functionality:
Route::get('/instructors', [InstructorsController::class, 'index']);
Route::get('/instructors/create', [InstructorsController::class, 'create']);
Route::post('/instructors/create', [InstructorsController::class, 'store']);
Route::delete('/instructors/{id}', [InstructorsController::class, 'destroy']);
Route::get('/instructors/edit/{id}', [InstructorsController::class, 'edit']);
Route::put('/instructors/edit/{id}', [InstructorsController::class, 'update']);

//Routes for safety tips functionality:
Route::get('/safetytips', [SafetytipsController::class, 'index']);
Route::get('/safetytips/create', [SafetytipsController::class, 'create']);
Route::post('/safetytips/create', [SafetytipsController::class, 'store']);
Route::delete('/safetytips/{id}', [SafetytipsController::class, 'destroy']);
Route::get('/safetytips/edit/{id}', [SafetytipsController::class, 'edit']);
Route::put('/safetytips/edit/{id}', [SafetytipsController::class, 'update']);

//Routes for discussions functionality:
Route::get('/discussions', [DiscussionsController::class, 'index']);
Route::get('/discussions/create', [DiscussionsController::class, 'create']);
Route::post('/discussions/create', [DiscussionsController::class, 'store']);
Route::delete('/discussions/{id}', [DiscussionsController::class, 'destroy']);
Route::get('/discussions/edit/{id}', [DiscussionsController::class, 'edit']);
Route::put('/discussions/edit/{id}', [DiscussionsController::class, 'update']);

// icons
Route::get('/create', [iconsController::class, 'iconpage']);
Route::post('/createicon', [iconsController::class, 'createicon']);
Route::get('/viewicon', [iconsController::class, 'showicon']);
Route::get('editicon/{id}',[iconsController::class,'editicon'])->name('editicon');
Route::post('updateicon/{id}',[iconsController::class,'updateicon'])->name('updateicon');
Route::get('/deleteicon/{id}', [iconsController::class,'deleteicon'])->name('/deleteicon');

Route::get('/home', 'HomeController@index')->name('home');
