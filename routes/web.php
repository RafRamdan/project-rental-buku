<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DummyController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\RentLogController;
use App\Http\Controllers\BookRentController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BorrowingUserController;

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
Route::get('index', [DummyController::class, 'index']);
Route::get('daftar', [DummyController::class, 'daftar']);
Route::get('dummy', [DummyController::class, 'dummy']);

Route::get('/', [PublicController::class, 'index']);
Route::get('/detail/{slug}', [BookController::class, 'show']);

Route::middleware('only_guest')->group(function(){
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'authenticating']);
    Route::get('/register', [AuthController::class, 'register']);
    Route::post('/register', [AuthController::class, 'registerProcess']);

});

Route::middleware('auth')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout']);

    Route::get('/user-rental', [BorrowingUserController::class, 'userRental'])->middleware('only_client');
    Route::post('/borrowing', [BorrowingUserController::class, 'borrowing'])->middleware('only_client');
    Route::get('/profile', [profileController::class, 'index'])->middleware('only_client');

    Route::middleware('only_officer')->group(function(){

        Route::get('/borrow-book/officer', [BookRentController::class, 'index']);
        Route::get('/borrow-book/officer/{id}/edit', [BookRentController::class, 'edit']);
        Route::put('/borrow-book/officer/{id}', [BookRentController::class, 'update']);
        
        Route::get('/return-book/officer', [BookRentController::class, 'returnBook']);
        Route::get('/return-book/officer/{id}/edit', [BookRentController::class, 'show']);
        Route::put('/return-book/officer/{id}', [BookRentController::class, 'saveReturnBook']);
            
        Route::get('/rent-logs/officer', [RentLogController::class, 'index']);
        Route::get('/exportpdf/officer', [RentLogController::class, 'exportpdf']);

        Route::get('/dashboard/officer', [DashboardController::class, 'index']);
        
        
    });
   
    Route::middleware('only_admin')->group(function(){

        Route::get('/dashboard', [DashboardController::class, 'index']);

        Route::get('/book', [BookController::class, 'index']);
        Route::get('/book/detail/{slug}', [BookController::class, 'show']);
        Route::get('/book/add', [BookController::class, 'add']);
        Route::post('book/add', [BookController::class, 'store']);
        Route::get('/book/edit/{slug}', [BookController::class, 'edit']);
        Route::post('/book/edit/{slug}', [BookController::class, 'update']);
        Route::get('/book/delete/{slug}', [BookController::class, 'delete']);
        Route::get('/book/destroy/{slug}', [BookController::class, 'destroy']);
        Route::get('/book/deleted', [BookController::class, 'deletedBook']);
        Route::get('/book/restore/{slug}', [BookController::class, 'restore']);

        Route::get('/category', [CategoryController::class, 'index']);
        Route::get('/category/add', [CategoryController::class, 'add']);
        Route::post('category/add', [CategoryController::class, 'store']);
        Route::get('/category/edit/{slug}', [CategoryController::class, 'edit']);
        Route::put('/category/edit/{slug}', [CategoryController::class, 'update']);
        Route::get('/category/delete/{slug}', [CategoryController::class, 'delete']);
        Route::get('/category/destroy/{slug}', [CategoryController::class, 'destroy']);
        Route::get('/category/deleted', [CategoryController::class, 'deletedCategory']);
        Route::get('/category/restore/{slug}', [CategoryController::class, 'restore']);

        Route::get('/user', [UserController::class, 'index']);
        Route::get('/user/registered', [UserController::class, 'registeredUser']);
        Route::get('/user/detail/{slug}', [UserController::class, 'show']);
        Route::get('/user/edit/{slug}', [UserController::class, 'edit']);
        Route::post('/user/edit/{slug}', [UserController::class, 'update']);
        Route::get('/user/approve/{slug}', [UserController::class, 'approve']);
        Route::get('/user/ban/{slug}', [UserController::class, 'delete']);
        Route::get('/user/destroy/{slug}', [UserController::class, 'destroy']);
        Route::get('/user/banned', [UserController::class, 'bannedUser']);
        Route::get('/user/restore/{slug}', [UserController::class, 'restore']);

        Route::get('/borrow-book', [BookRentController::class, 'index']);
        Route::get('/borrow-book/{id}/edit', [BookRentController::class, 'edit']);
        Route::put('/borrow-book/{id}', [BookRentController::class, 'update']);
        
        Route::get('/return-book', [BookRentController::class, 'returnBook']);
        Route::get('/return-book/{id}/edit', [BookRentController::class, 'show']);
        Route::put('/return-book/{id}', [BookRentController::class, 'saveReturnBook']);
            
        Route::get('/rent-logs', [RentLogController::class, 'index']);
        Route::get('/exportpdf', [RentLogController::class, 'exportpdf']);

        
    });

});