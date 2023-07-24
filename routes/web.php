<?php

use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\TokenVerificationMiddleware;
use Illuminate\Support\Facades\Route;


Route::post('/user-registration',[UserController::class,'userRegistration']);
Route::post('/UserLogin',[UserController::class,'userLogin']);
Route::post('/sendOtpToEmail',[UserController::class,'sendOtpToEmail']);
Route::post('/otpVerify',[UserController::class,'otpVerify']);
Route::post('/setPassword',[UserController::class,'setPassword'])->middleware([TokenVerificationMiddleware::class]);

// profile route details
Route::get('/user-profile-details',[UserController::class,'getUser'])->middleware([TokenVerificationMiddleware::class]);
//profile update
Route::post('/profile-update',[UserController::class,'profileUpdate'])->middleware([TokenVerificationMiddleware::class]);



// todo-list route
Route::get('/getTodoList',[TodoController::class,'getTodoList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/create-todoList',[TodoController::class,'createList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/update-todoList',[TodoController::class,'updateList'])->middleware([TokenVerificationMiddleware::class]);
Route::post('/delete-todoList',[TodoController::class,'deleteList'])->middleware([TokenVerificationMiddleware::class]);


