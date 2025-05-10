<?php
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactMessageController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PackageOrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\SeoController;
use App\Http\Controllers\SettingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Auth routes
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
Route::get('me', [AuthController::class, 'me'])->middleware('auth:api');
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:api');

/* create by abu sayed (start)*/ 

Route::post('password/email', [AuthController::class, 'sendResetEmailLink']);
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.reset');



/* create by abu sayed (end)*/ 

// Protected routes
//profile
Route::middleware('auth:api')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show']);
    Route::post('/profile', [ProfileController::class, 'storeOrUpdate']);
});

//settings
Route::middleware('auth:api')->group(function () {
    Route::get('/settings', [SettingController::class, 'show']);
    Route::post('/settings', [SettingController::class, 'storeOrUpdate']);
});

//seo
Route::middleware('auth:api')->group(function () {
    Route::get('/seo/{slug}', [SeoController::class, 'show']);
    Route::post('/seo', [SeoController::class, 'storeOrUpdate']);
});


//package info bronze 
Route::middleware('auth:api')->group(function () {
    Route::get('/packageinfo/bronze', [PackageController::class, 'BronzeShow']);
    Route::post('/packageinfo/bronze', [PackageController::class, 'storeOrUpdateBronze']);
});

//package info silver
Route::middleware('auth:api')->group(function () {
    Route::get('/packageinfo/silver', [PackageController::class, 'SilverShow']);
    Route::post('/packageinfo/silver', [PackageController::class, 'storeOrUpdateBronze']);
});

//package info gold
Route::middleware('auth:api')->group(function () {
    Route::get('/packageinfo/gold', [PackageController::class, 'goldShow']);
    Route::post('/packageinfo/gold', [PackageController::class, 'storeOrUpdateGold']);
});


Route::post('/package-order/{slug}', [PackageOrderController::class, 'store']);
Route::get('/notification', [PackageOrderController::class, 'index'])->middleware('auth:api');


Route::post('/contactMessage', [ContactMessageController::class, 'store']);


//all package shows 
Route::middleware('auth:api')->group(function () {
    Route::get('/package-order-shows/gold', [PackageOrderController::class, 'goldAllShow']);
    Route::get('/package-order-shows/silver', [PackageOrderController::class, 'silverAllShow']);
    Route::get('/package-order-shows/bronze', [PackageOrderController::class, 'bronzeAllShow']);
});

//blogs
Route::middleware('auth:api')->group(function () {
    Route::apiResource('blog', BlogController::class);
});
Route::get('/blog-data-front', [BlogController::class, 'getBlogData']);