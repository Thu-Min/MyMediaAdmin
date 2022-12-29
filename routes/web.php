<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ListController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\TrendPostController;

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
    return view('welcome');
});

// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('admin.profile.index');
//     })->name('dashboard');
// });

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function() {
    // admin
    Route::get('dashboard', [ProfileController::class, 'index'])->name('dashboard');
    Route::post('admin/update', [ProfileController::class, 'updateAdmin'])->name('admin#update');
    Route::get('admin/changePassword', [ProfileController::class, 'changePasswordBlade'])->name('admin#changePasswordBlade');
    Route::post('admin/changePassword', [ProfileController::class, 'changePassword'])->name('admin#changePassword');

    // admin list
    Route::get('admin/list', [ListController::class, 'index'])->name('admin#list');
    Route::post('admin/delete/{id}', [ListController::class, 'deleteAccount'])->name('admin#deleteAccount');
    Route::post('admin/list', [ListController::class, 'search'])->name('admin#search');

    // category
    Route::get('admin/category/list', [CategoryController::class, 'index'])->name('admin#category');
    Route::post('admin/category', [CategoryController::class, 'create'])->name('admin#categoryCreate');
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete'])->name('admin#categoryDelete');
    Route::post('admin/category/list', [CategoryController::class, 'search'])->name('admin#categorySearch');
    Route::get('admin/category/editPage/{id}', [CategoryController::class, 'editPage'])->name('admin#categoryEditPage');
    Route::post('admin/category/edit/{id}', [CategoryController::class, 'edit'])->name('admin#categoryEdit');

    // post
    Route::get('admin/post', [PostController::class, 'index'])->name('admin#post');
    Route::post('admin/post', [PostController::class, 'createPost'])->name('admin#createPost');
    Route::get('admin/post/delete/{id}', [PostController::class, 'deletePost'])->name('admin#deletePost');
    Route::get('admin/post/update/{id}', [PostController::class, 'updatePost'])->name('admin#updatePost');
    Route::post('admin/post/update/{id}', [PostController::class, 'updatePostProcess'])->name('admin#updatePostProcess');

    // trend post
    Route::get('trendPost', [TrendPostController::class, 'index'])->name('admin#trendPost');
    Route::get('trendPost/details/{id}', [TrendPostController::class, 'trendPostDetails'])->name('admin#trendPostDetails');
});
