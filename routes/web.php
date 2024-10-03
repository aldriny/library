<?php

use App\Http\Controllers\auth\changePasswordController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\EmailVerificationController;
use App\Http\Controllers\Auth\ForgotPasswordController;

//home page
Route::get('/', [HomeController::class, 'show'])->name('home');

Route::middleware('guest')->group(function () {
    // Register routes
    Route::controller(RegisterController::class)->group(function () {
        Route::get('/register', 'showRegister')->name('showRegister');
        Route::post('/register', 'register')->name('register');
    });

    // Login routes
    Route::controller(LoginController::class)->group(function () {
        Route::get('/login', 'showLogin')->name('showLogin');
        Route::post('/login', 'login')->name('login');
    });

    // Forgot Password routes
    Route::controller(ForgotPasswordController::class)->group(function () {
        Route::get('/password/reset', 'showForgotPassword')->name('password.request');
        Route::post('/password/email', 'sendResetLinkEmail')->name('password.email');
        Route::get('/password/reset/{token}', 'showResetPassword')->name('password.reset');
        Route::post('/password/reset', 'resetPassword')->name('password.update');
    });
});


Route::middleware('auth')->group(function () {
    // Email verification routes
    Route::controller(EmailVerificationController::class)->group(function () {
        Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->middleware(['signed'])->name('verification.verify');
        Route::get('/email/verify', 'showVerifyEmail')->name('verification.notice');
        Route::post('/email/resend', 'resendEmailVerification')->middleware('throttle:6,1')->name('verification.resend');
    });

    // change password
    Route::controller(changePasswordController::class)->group(function () {
        Route::get('/change-password', 'showChangePassword')->name('showChangePassword');
        Route::post('/change-password', 'changePassword')->name('changePassword');
    });
    // Logout route
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
});

Route::controller(CategoryController::class)->group(function () {

    //show categories
    Route::get('/categories', 'index')->name('categories');
    //show category
    Route::get('/category/{id}', 'show')->name('showCategory');

    Route::middleware('admin')->group(function () {

        //add category
        Route::get('/add-category', 'showCreate')->name('showCreateCategory');
        Route::post('/add-category', 'create')->name('createCategory');
        //edit category
        Route::get('/edit-category/{id}', 'showEdit')->name('showEditCategory');
        Route::put('/edit-category/{id}', 'edit')->name('editCategory');
        //delete category
        Route::delete('/category/{id}', 'delete')->name('deleteCategory');
    });
});



Route::controller(AuthorController::class)->group(function () {

    //show authors
    Route::get('/authors', 'index')->name('authors');
    //show author
    Route::get('/author/{id}', 'show')->name('showAuthor');

    Route::middleware('admin')->group(function () {
        //add author
        Route::get('/add-author', 'showCreate')->name('showCreateAuthor');
        Route::post('/add-author', 'create')->name('createAuthor');
        //edit author
        Route::get('/edit-author/{id}', 'showEdit')->name('showEditAuthor');
        Route::put('/edit-author/{id}', 'edit')->name('editAuthor');
        //delete author
        Route::delete('/author/{id}', 'delete')->name('deleteAuthor');
    });
});

Route::controller(BookController::class)->group(function () {

    //show books
    Route::get('/books', 'index')->name('books');
    //show book
    Route::get('/book/{id}', 'show')->name('showBook');


    Route::middleware('admin')->group(function () {
        //add book
        Route::get('/add-book', 'showCreate')->name('showCreateBook');
        Route::post('/add-book', 'create')->name('createBook');

        //edit book
        Route::get('/edit-book/{id}', 'showEdit')->name('showEditBook');
        Route::put('/edit-book/{id}', 'edit')->name('editBook');
        //delete author
        Route::delete('/book/{id}', 'delete')->name('deleteBook');
    });
});
