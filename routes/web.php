<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\GymController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\FindGymController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ReportController;

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

//Authetication//
Route::get('/login',[AuthController::class,'loginuser'])->name('loginuser');
Route::get('/register',[AuthController::class,'registration'])->name('registration');
Route::get('/', [AuthController::class, 'getstarted'])->name('getstarted');
Route::get('/select-gym', [AuthController::class, 'selectGym'])->name('gym.index');
Route::get('logout',[AuthController::class,'logout']);
Route::post('login',[AuthController::class,'Authlogin'])->name('login');
Route::post('register', [AuthController::class, 'register'])->name('register');

// forgot password // 
Route::get('forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');
Route::post('reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

//for finding gym//

Route::get('/findgym', [FindGymController::class, 'findgym'])->name('findgym');



Route::group(['middleware' => 'admin'],function(){
    
    Route::get('/admin/dashboard',[DashboardController::class,'dashboard']);

    // Announcements //
    Route::get('/admin/announcements', [AnnouncementController::class, 'index'])->name('admin.announcements.index');
    Route::delete('announcements/{announcement}', [AnnouncementController::class, 'destroy'])->name('announcements.destroy');

    // Activity Logs //
    Route::get('/admin/activity-logs', [ActivityLogController::class, 'index'])->name('admin.activity_logs');
    
    // Users List - Admin //
    Route::get('/admin/users', [UserController::class, 'index'])->name('Admin.adminuserlist');
    Route::delete('/admin/users/{user}', [UserController::class, 'delete'])->name('users.delete');
    Route::get('/admin/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/admin/users/{user}', [UserController::class, 'update'])->name('users.update');

    // Staff List - Admin //
    Route::get('/admin/staff', [UserController::class, 'staff'])->name('Admin.adminstafflist');
    Route::delete('/admin/staff/{staffMember}', [UserController::class, 'destroyStaffMember'])->name('staff.destroy');
    Route::get('/admin/staff/{staffMember}/edit', [UserController::class, 'editStaffMember'])->name('staff.edit');
    Route::put('/admin/staff/{staffMember}', [UserController::class, 'updateStaffMember'])->name('staff.update');




    //CRUD GYM//
    Route::get('/gyms/create', [GymController::class, 'create'])->name('gymcreate');
    Route::post('/gyms', [GymController::class, 'store'])->name('gyms.store');
    Route::get('/gyms/{id}/edit', [GymController::class, 'edit'])->name('gyms.edit');
    Route::put('/gyms/{id}', [GymController::class, 'update'])->name('gyms.update');
    Route::delete('/gyms/{id}', [GymController::class, 'destroy'])->name('gyms.destroy');
    Route::get('/gyms/{id}', [GymController::class, 'show'])->name('gyms.show');
    Route::get('/gyms', [GymController::class, 'index'])->name('gyms.index');

});

Route::group(['middleware' => 'staff'],function(){

    Route::get('/staff/dashboard',[DashboardController::class,'dashboard'])->name('staffdashboard');

    // Announcements // 
    Route::resource('announcements', AnnouncementController::class)->only([
        'index', 'create', 'store']);

    // Trainer List //
    Route::get('/staff/trainers/list', [ListController::class, 'trainer'])->name('trainer.list');
    Route::delete('/trainers/{id}', [ListController::class, 'deleteTrainer'])->name('trainer.delete');    

    // User List //
    Route::get('/staff/users/list', [ListController::class, 'index'])->name('users.index');
    Route::delete('/users/{user}', [ListController::class, 'destroy'])->name('users.destroy');

    // Attendance //
    Route::get('/staff/check-in', [AttendanceController::class, 'showCheckInForm'])->name('attendance.checkin.form');
    Route::post('/staff/check-in', [AttendanceController::class, 'checkIn'])->name('attendance.checkin');


    // Subscription Activation //

    Route::post('/subscriptions/{subscriptionId}/activate', [ListController::class, 'activateSubscription'])->name('subscriptions.activate');

    Route::get('staff/reports', [ReportController::class, 'staffReport'])->name('staff.reports');

    

});

Route::group(['middleware' => 'user'],function(){

    Route::get('/user/dashboard',[DashboardController::class,'dashboard'])->name('userdashboard');

    

    // Tasks //
    Route::get('/user/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/user/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');

    // Subscriptions //
    Route::get('/user/subscriptions', [SubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::post('/subscriptions', [SubscriptionController::class, 'store'])->name('subscriptions.store');
    Route::post('/subscriptions/{subscriptionId}/cancel', [SubscriptionController::class, 'cancel'])->name('subscriptions.cancel');

    Route::get('user/reports', [ReportController::class, 'userReport'])->name('user.reports');

});




// Route group with authentication middleware to ensure only logged-in users can access these routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route to handle the profile update form submission
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});