<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\ApiPostController;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiActionLogController;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/login', [AuthController::class, 'login']);
Route::post('user/register', [AuthController::class, 'register']);

Route::get('allPost', [ApiPostController::class, 'allPost']);
Route::post('post/search', [ApiPostController::class, 'postSearch']);
Route::post('post/details', [ApiPostController::class, 'postDetails']);

Route::get('allCategory', [ApiCategoryController::class, 'category']);
Route::post('category/search', [ApiCategoryController::class, 'categorySearch']);

Route::post('post/actionLog', [ApiActionLogController::class, 'setActionLog']);
