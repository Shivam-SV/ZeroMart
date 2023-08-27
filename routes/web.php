<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::group(['module' => 'authentication', 'middleware' => 'unauth'],function(){
    # login
    Route::view('/login','auth.login')->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    # sign up
    Route::view('/register','auth.register');
    Route::post('/register',[AuthController::class, 'register'])->name('register');
    Route::view('/registed','auth.registered')->name('registed');
    Route::get('/verify-email',[AuthController::class, 'verifyEmail'])->name('verify-email');
    # forgot password
    Route::view('/find-account','auth.find-account')->name('find-account');
    Route::post('find-user',[AuthController::class, 'findByEmail'])->name('find-user');

    Route::get('send-otp',[AuthController::class, 'sendOtp'])->name('send-otp');
    Route::post('/verify-otp',[AuthController::class, 'verifyOtp'])->name('verify-otp');
    Route::get('change-password/{userId}', [AuthController::class, 'changePassword'])->name('change-password');
    Route::post('update-password',[AuthController::class, 'updatePassword'])->name('update-password');
});

Route::group(['module' => 'home', 'middleware' => 'auth'],function(){
    Route::view('/','home')->name('home');

    Route::get('logout',function(){
        auth()->logout();
        return redirect(route('login'));
    });

    Route::get('/profile/{userId}', function($userId){
        $user = User::findOrFail(normalizeId($userId));
        return view('profile', compact('user'));
    })->name('profile');
});
