<?php

use App\Http\Controllers\userscontroller;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\SchoolsController;
use App\Http\Controllers\InstructorsController;
use App\Http\Controllers\iconsController;
use App\Http\Controllers\SafetytipsController;
use App\Http\Controllers\DiscussionsController;
use App\Http\Controllers\DepartmentsController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\AboutPageController;
use App\Http\Controllers\AssignmentsController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\CourseResourcesController;
use App\Http\Controllers\CourseLinkController;
use App\Http\Controllers\MessagesController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoomsController;
use App\Http\Controllers\UserGuideController;
use App\Http\Controllers\QuizzesController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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


//Default (/) route
Route::get('/', function () {
    return view('users.loginpage');
});


//User Guide Route
Route::get('/userguide', [UserGuideController::class, 'index']);


//Quizzes routes
Route::get('/quizzes/create', [QuizzesController::class, 'create']);
Route::get('/mcq/create', [QuizzesController::class, 'mcqcreate']);
Route::post('/mcq/store', [QuizzesController::class, 'mcqstore']);
Route::get('/tf/create', [QuizzesController::class, 'tfcreate']);
Route::post('/tf/store', [QuizzesController::class, 'tfstore']);



//Assignments Routes
Route::get('/assignments/create', [AssignmentsController::class, 'create']);


//Dashboard Route
Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth']);


//Calendar Route
Route::get('/calendar', [CalendarController::class, 'index']);


//profile
Route::get('/showprofile', [ProfileController::class, 'show_profile']);
Route::get('/editprofile', [ProfileController::class, 'edit_profile']);
Route::post('/updateprofile/{id}', [ProfileController::class, 'updateprofile']);
Route::post('/updatecontact', [ProfileController::class, 'updatecontact']);

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
// Route::post('/createstudent', [userscontroller::class, 'createstudent']);
// Route::post('/createinstructor', [userscontroller::class, 'createinstructor']);
// Route::post('/createschool', [userscontroller::class, 'createschool']);


//course crud
Route::get('/course/{cat}', [CourseController::class, 'course_wise_url']);
Route::get('/getcourses', [CourseController::class, 'get_courses']);

Route::get('/course', [CourseController::class, 'course'])->name('courses');
Route::get('/courses', [CourseController::class, 'coursecreate']);
Route::post('/createcourse', [CourseController::class, 'coursestore']);
Route::get('/course/replicate/{id}',  [CourseController::class, 'course_replicate']);
Route::get('/course/edit/{id}',  [CourseController::class, 'course_edit']);
Route::post('/course/update/{id}',  [CourseController::class, 'course_update']);
Route::post('/course/delete',  [CourseController::class, 'destroy']);
Route::get('search',  [CourseController::class, 'search']);

// dependent dropdown routes for students
Route::get('/get-instructors', [StudentsController::class, 'get_instructors']);
Route::get('/get-students', [StudentsController::class, 'get_students']);



//students crud
Route::get('/students', [StudentsController::class, 'students'])->name('students');
Route::get('/studentcreate', [StudentsController::class, 'create']);
Route::post('/studentstore', [StudentsController::class, 'store']);
Route::get('/student/edit/{id}',  [StudentsController::class, 'edit']);
Route::get('/student/show/{id}',  [StudentsController::class, 'show']);
Route::post('/student/update/{id}',  [StudentsController::class, 'update']);
Route::post('/student/delete',  [StudentsController::class, 'destroy']);


//classes crud
Route::get('/classes', [ClassController::class, 'index'])->name('classes');
Route::get('/classcreate', [ClassController::class, 'create']);
Route::post('/classstore', [ClassController::class, 'store']);
Route::get('/class/edit/{id}',  [ClassController::class, 'edit']);
Route::get('/class/show/{id}',  [ClassController::class, 'show']);
Route::post('/class/update/{id}',  [ClassController::class, 'update']);
Route::post('/class/delete',  [ClassController::class, 'destroy']);


//School crud
Route::get('/schools', [SchoolsController::class, 'schools'])->name('school');
Route::get('/schoolcreate', [SchoolsController::class, 'create']);
Route::post('/schoolstore', [SchoolsController::class, 'store']);
Route::get('/school/show/{id}', [SchoolsController::class, 'show']);
Route::get('/school/edit/{id}',  [SchoolsController::class, 'edit']);
Route::post('/school/update/{id}',  [SchoolsController::class, 'update']);
Route::post('/school/delete',  [SchoolsController::class, 'destroy']);


//Routes for Instructors functionality:
Route::get('/instructors', [InstructorsController::class, 'index']);
Route::get('/instructors/create', [InstructorsController::class, 'create']);
Route::post('/instructors/create', [InstructorsController::class, 'store']);
Route::get('/instructors/delete', [InstructorsController::class, 'destroy']);
Route::get('/instructors/show/{id}', [InstructorsController::class, 'show']);
Route::get('/instructors/edit/{id}', [InstructorsController::class, 'edit']);
Route::POST('/instructors/edit/{id}', [InstructorsController::class, 'update']);


//Routes for safety tips functionality:
Route::get('/safetytips', [SafetytipsController::class, 'index']);
Route::get('/safetytips/create', [SafetytipsController::class, 'create']);
Route::post('/safetytips/create', [SafetytipsController::class, 'store']);
Route::get('/safetytips/delete', [SafetytipsController::class, 'destroy']);
Route::get('/safetytips/edit/{id}', [SafetytipsController::class, 'edit']);
Route::put('/safetytips/edit/{id}', [SafetytipsController::class, 'update']);


//Routes for discussions functionality:
Route::get('/discussions', [DiscussionsController::class, 'index']);
Route::get('/discussions/create', [DiscussionsController::class, 'create']);
Route::post('/discussions/create', [DiscussionsController::class, 'store']);
Route::get('/discussions/delete', [DiscussionsController::class, 'destroy']);
Route::get('/discussions/edit/{id}', [DiscussionsController::class, 'edit']);
Route::put('/discussions/edit/{id}', [DiscussionsController::class, 'update']);


//Routes for departments functionality:
Route::get('/departments', [DepartmentsController::class, 'index']);
Route::get('/departments/create', [DepartmentsController::class, 'create']);
Route::post('/departments/create', [DepartmentsController::class, 'store']);
Route::get('/departments/delete', [DepartmentsController::class, 'destroy']);
Route::get('/departments/edit/{id}', [DepartmentsController::class, 'edit']);
Route::put('/departments/edit/{id}', [DepartmentsController::class, 'update']);


//Routes for rooms functionality:
Route::get('/rooms', [RoomsController::class, 'index']);
Route::get('/rooms/create', [RoomsController::class, 'create']);
Route::post('/rooms/create', [RoomsController::class, 'store']);
Route::get('/rooms/delete', [RoomsController::class, 'destroy']);
Route::get('/rooms/edit/{id}', [RoomsController::class, 'edit']);
Route::put('/rooms/edit/{id}', [RoomsController::class, 'update']);   


// icons
Route::get('/create', [iconsController::class, 'iconpage']);
Route::post('/createicon', [iconsController::class, 'createicon']);
Route::get('/viewicon', [iconsController::class, 'showicon']);
Route::get('editicon/{id}',[iconsController::class,'editicon'])->name('editicon');
Route::post('updateicon/{id}',[iconsController::class,'updateicon'])->name('updateicon');
Route::get('/deleteicon/{id}', [iconsController::class,'deleteicon'])->name('/deleteicon');


// settings
Route::get('setting', [SettingsController::class, 'setting'])->name('setting');
Route::post('update',  [SettingsController::class, 'update'])->name('update');


// pages
Route::get('/aboutpage', [AboutPageController::class, 'index']);
Route::post('/updateabout/{id}',[AboutPageController::class,'update']);
Route::get('/contactpage', [ContactPageController::class, 'index']);
Route::post('/updatecontact/{id}',[ContactPageController::class,'update']);


//Routes for Course Resources functionality:
Route::get('/courseresourse/{id}', [CourseResourcesController::class, 'index'])->name('/courseresourse');
Route::get('/courseresoursevideo/{id}', [CourseResourcesController::class, 'resourcevideo']);
Route::get('/courseresoursevideo/{id}', [CourseResourcesController::class, 'resourcevideos']);
Route::get('/resource', [CourseResourcesController::class, 'create'])->name('/resource');
Route::get('/resources', [CourseResourcesController::class, 'resources'])->name('/resources');
Route::post('/resource/create', [CourseResourcesController::class, 'storefile']);
Route::post('/resourcevid/create', [CourseResourcesController::class, 'storevid']);
Route::get('/deleteres/{id}', [CourseResourcesController::class, 'deleteres']);
Route::get('/deletevid/{id}', [CourseResourcesController::class, 'deletevid']);
Route::get('/resource/edit/{id}/{main}', [CourseResourcesController::class, 'editfile']);
Route::get('resource/editvid/{id}/{main}', [CourseResourcesController::class, 'editvid']);
Route::post('/resource/update/{id}', [CourseResourcesController::class, 'updateres'])->name('resource/update');
Route::post('/resourcevid/update', [CourseResourcesController::class, 'updatevid'])->name('resourcevid/update');
Route::get('resource/download/{id}', [CourseResourcesController::class, 'download'])->name('/download');


// Routes for Course Link:
Route::get('courselink/{id}', [CourseLinkController::class, 'index']);
Route::post('/linkcreate', [CourseLinkController::class, 'store']);
Route::get('/linkedit/{id}/{main}', [CourseLinkController::class, 'edit']);
Route::post('/linkupdate', [CourseLinkController::class, 'update']);
Route::get('/linkdelete/{id}', [CourseLinkController::class, 'delete']);

//messages
Route::get('/messages', [MessagesController::class, 'messages'])->name('All Message');
Route::get('/chatbox/{id}', [MessagesController::class, 'messages'])->name('Send Message');
Route::post('/sendmessage', [MessagesController::class, 'sendMessage']);

//IDK
Auth::routes();
