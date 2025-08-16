<?php

use App\Http\Controllers\api\app\Directorate\DirectorateController;
use App\Http\Controllers\api\app\EmploymentType\EmploymentTypeController;
use App\Http\Controllers\api\app\InternetUser\InternetUserController;
use App\Http\Controllers\Api\App\Person\PersonController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\api\app\Device_type\DeviceTypeController;
use App\Http\Controllers\api\app\Violation\ViolationTypeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\app\Violation\ViolationController;
use App\Http\Controllers\Api\Group\GroupController;

Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::middleware('auth:sanctum')->group(function () {
    Route::put('/update-profile/{id}', [AuthController::class,'updateProfile'])->middleware('check.access:permission=update-users');
    Route::get('/profile', [AuthController::class, 'profile'])->middleware('check.access:permission=view-users');
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/register', [AuthController::class, 'register'])->middleware('check.access:permission=create-users');
    Route::get('/internet',[InternetUserController::class, 'index']);
    Route::post('/violation',[ViolationTypeController::class, 'store'])->middleware('check.access:permission=add-system-data');
    Route::delete('/violation/{id}', [ViolationTypeController::class,'destroy'])->middleware('check.access:permission=delete-system-data');
    Route::put('/violation/{id}',[ViolationTypeController::class,'update'])->middleware('check.access:permission=update-system-data');
    Route::post('/violationOnaUser', [ViolationController::class, 'store'])->middleware('check.access:permission=add-system-data');
    Route::get('/violation',[ViolationTypeController::class,'index']);
    Route::get('/user',[AuthController::class,'index']);
    Route::put('/user/{id}', [AuthController::class, 'systemUsersUpdate'])->middleware('check.access:permission=update-system-data');
    Route::delete('/user/{id}', [AuthController::class, 'systemUsersDelete'])->middleware('check.access:permission=delete-system-data'); 
    Route::post('/internet', [InternetUserController::class,'store'])->middleware('check.access:permission=add-system-data');
     Route::put('/internet/{id}', [InternetUserController::class, 'update'])->middleware('check.access:permission=update-system-data');
    Route::delete('/internet/{id}',[InternetUserController::class,'destroy'])->middleware('check.access:permission=delete-system-data');
    Route::get('/allViolationsFromUsers', [ViolationController::class, 'index']);
    Route::get('/groups',[GroupController::class,'index']);
    Route::get('/device-types', [DeviceTypeController::class, 'index']);
    Route::post('/check-username', [InternetUserController::class, 'checkUsername']);
    Route::post('/check-email-of-internet-users', [InternetUserController::class, 'checkEmailInternetUser']);
    Route::post('/check-phone-of-internet-user', [InternetUserController::class, 'checkPhoneOfInternetUsers']);
    Route::post('/check-mac-address', [InternetUserController::class, 'checkMacAddress']);
    Route::get('/group-type-counts', [GroupController::class, 'countsByType']);
    Route::get('/employment-type',[EmploymentTypeController::class,'index']);
    Route::get('/directorate',[DirectorateController::class,'index']);
    Route::put('/users/{id}/status', [InternetUserController::class,'updateStatus'])->middleware('check.access:permission=update-system-data');
    Route::get('/employment-type-counts',[EmploymentTypeController::class,'employmentTypeCounts']);
    Route::get('/total-users', [InternetUserController::class, 'getTotalUsers']);
    Route::post('/check-email', [AuthController::class, 'checkEmail']);
});