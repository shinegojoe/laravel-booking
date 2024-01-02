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
use App\Http\Controllers\XXXController;
use App\Http\Middleware\ValidateToken;


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


// ----- booking -----
Route::prefix(booking)->group(function () {
    Route::post('/create', [BookginController::class, "create"])->middleware(ValidateToken::class);
    Route::post('/bookingHistory', [BookginController::class, "bookingHistory"])->middleware(ValidateToken::class);
    Route::get('/customerHistory', [BookginController::class, "customerHistory"])->middleware(ValidateToken::class);
    Route::put('/update', [BookginController::class, "update"])->middleware(ValidateToken::class);
});


// ----- calendar -----
Route::prefix(calendar)->group(function () {
    Route::post('/booking', [CalendarController::class, "booking"])->middleware(ValidateToken::class);
    Route::get('/coach', [CalendarController::class, "coach"]);
    Route::get('/customer', [CalendarController::class, "customer"]);
});


// ----- course ------
Route::prefix(course)->group(function () {
    Route::post('/create', [CourseController::class, "create"])->middleware(ValidateToken::class);
    Route::get('/listByCoachId', [CourseController::class, "listByCoachId"])->middleware(ValidateToken::class);
    Route::get('/listByClientId', [CourseController::class, "listByClientId"])->middleware(ValidateToken::class);
    Route::patch('/deactivate', [CourseController::class, "deactivate"])->middleware(ValidateToken::class);
    Route::patch('/setActivate', [CourseController::class, "setActivate"])->middleware(ValidateToken::class);

});

// ----- courseRegistraction
Route::prefix(courseRegistraction)->group(function () {
    Route::post('/getByUIdAndCourseId', [CourseRegistartionController::class, "getByUIdAndCourseId"])->middleware(ValidateToken::class);
    Route::get('/listByUId', [CourseRegistartionController::class, "listByUId"])->middleware(ValidateToken::class);
    Route::get('/customerListVO', [CourseRegistartionController::class, "customerListVO"])->middleware(ValidateToken::class);
});


// ----- default config -----
Route::prefix(defaultConfig)->group(function () {
    Route::get('/getByCourseId', [DefaultConfigController::class, "getByCourseId"])->middleware(ValidateToken::class);
    Route::put('/update', [DefaultConfigController::class, "update"])->middleware(ValidateToken::class);
});

// ----- login -----
Route::prefix(login)->group(function () {
    Route::get('/googleOauth2Login', [LoginController::class, "googleOauth2Login"]);
    Route::get('/isValidate', [LoginController::class, "isValidate"]);
    Route::get('/checkLogin', [LoginController::class, "checkLogin"]);
});


// ----- paymentHistory -----
Route::prefix(paymentHistory)->group(function () {
    Route::post('/create', [PaymentHistoryController::class, "create"])->middleware(ValidateToken::class);
    Route::put('/update', [PaymentHistoryController::class, "update"])->middleware(ValidateToken::class);
    Route::post('/listByCourseIdAndUId', [PaymentHistoryController::class, "listByCourseIdAndUId"])->middleware(ValidateToken::class);
});

// ----- syncCanendar -----
Route::prefix(syncCalendar)->group(function () {
    Route::get('/syncCalendar', [SyncCalendarController::class, "syncCalendar"])->middleware(ValidateToken::class);
});

// ----- userConfig -----
Route::prefix(userConfig)->group(function () {
    Route::patch('/update', [UserConfigController::class, "update"])->middleware(ValidateToken::class);
    Route::patch('/updateIsSyncCalendar', [UserConfigController::class, "updateIsSyncCalendar"])->middleware(ValidateToken::class);
    Route::patch('/updateIsDefaultCoach', [UserConfigController::class, "updateIsDefaultCoach"])->middleware(ValidateToken::class);

});

// ----- user -----
Route::prefix(user)->group(function () {
    Route::get('/listByCourseId', [UserController::class, "listByCourseId"])->middleware(ValidateToken::class);
    Route::get('/userVO', [UserController::class, "userVO"])->middleware(ValidateToken::class);

});

// Route::prefix("xxx")->group(function () {
//     Route::get('/test123', [XXXController::class, "test123"])->middleware(ValidateToken::class);

// });
