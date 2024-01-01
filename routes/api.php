<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller123;
use App\Http\Controllers\BookginController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CourseRegistartionController;
use App\Http\Controllers\DefaultConfigController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentHistoryController;
use App\Http\Controllers\SyncCalendarController;
use App\Http\Controllers\UserConfigController;
use App\Http\Controllers\UserController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::apiResource('/test123', [Controller123::class, 'index']);
Route::get('/test123', [Controller123::class, 'test2']);
Route::post('/testPost', [Controller123::class, 'testPost']);

Route::prefix('xxx')->group(function () {
    Route::get('/users', [Controller123::class, "test2"]);
});

const booking = 'booking';
const calendar = 'calendar';
const course = 'course';
const courseRegistraction = 'courseRegistartion';
const defaultConfig = 'defaultConfig';
const login = 'login';
const paymentHistory = 'paymentHistory';
const syncCalendar = 'syncCalendar';
const userConfig = 'userConfig';
const user = 'user';



// Verb	URI	Action	Route Name
// GET	/photos	index	photos.index
// GET	/photos/create	create	photos.create
// POST	/photos	store	photos.store
// GET	/photos/{photo}	show	photos.show
// GET	/photos/{photo}/edit	edit	photos.edit
// PUT/PATCH	/photos/{photo}	update	photos.update
// DELETE	/photos/{photo}	destroy	photos.destroy

// ----- booking -----
Route::prefix(booking)->group(function () {
    Route::post('/create', [BookginController::class, "create"]);
    Route::post('/bookingHistory', [BookginController::class, "bookingHistory"]);
    Route::get('/customerHistory', [BookginController::class, "customerHistory"]);
    Route::put('/update', [BookginController::class, "update"]);
});


// ----- calendar -----
Route::prefix(calendar)->group(function () {
    Route::get('/booking', [CalendarController::class, "booking"]);
    Route::get('/coach', [CalendarController::class, "coach"]);
    Route::get('/customer', [CalendarController::class, "customer"]);
});


// ----- course ------
Route::prefix(course)->group(function () {
    Route::post('/create', [CourseController::class, "create"]);
    Route::get('/listByCoachId', [CourseController::class, "listByCoachId"]);
    Route::get('/listByClientId', [CourseController::class, "listByClientId"]);
    Route::patch('/deactivate', [CourseController::class, "deactivate"]);
    Route::patch('/setActivate', [CourseController::class, "setActivate"]);

});

// ----- courseRegistraction
Route::prefix(courseRegistraction)->group(function () {
    Route::post('/getByUIdAndCourseId', [CourseRegistartionController::class, "getByUIdAndCourseId"]);
    Route::get('/listByUId', [CourseRegistartionController::class, "listByUId"]);
    Route::get('/customerListVO', [CourseRegistartionController::class, "customerListVO"]);
});


// ----- default config -----
Route::prefix(defaultConfig)->group(function () {
    Route::get('/getByCourseId', [DefaultConfigController::class, "getByCourseId"]);
    Route::put('/update', [DefaultConfigController::class, "update"]);
});

// ----- login -----
Route::prefix(login)->group(function () {
    Route::get('/googleOauth2Login', [LoginController::class, "googleOauth2Login"]);
    Route::get('/isValidate', [LoginController::class, "isValidate"]);
    Route::get('/checkLogin', [LoginController::class, "checkLogin"]);
});


// ----- paymentHistory -----
Route::prefix(paymentHistory)->group(function () {
    Route::post('/create', [PaymentHistoryController::class, "create"]);
    Route::put('/update', [PaymentHistoryController::class, "update"]);
    Route::post('/listByCourseIdAndUId', [PaymentHistoryController::class, "listByCourseIdAndUId"]);
});

// ----- syncCanendar -----
Route::prefix(syncCalendar)->group(function () {
    Route::get('/syncCalendar', [SyncCalendarController::class, "syncCalendar"]);
});

// ----- userConfig -----
Route::prefix(userConfig)->group(function () {
    Route::patch('/update', [UserConfigController::class, "update"]);
    Route::patch('/updateIsSyncCalendar', [UserConfigController::class, "updateIsSyncCalendar"]);
    Route::patch('/updateIsDefaultCoach', [UserConfigController::class, "updateIsDefaultCoach"]);

});

// ----- user -----
Route::prefix(user)->group(function () {
    Route::get('/listByCourseId', [UserController::class, "listByCourseId"]);
    Route::get('/userVO', [UserController::class, "userVO"]);

});
