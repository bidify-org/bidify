<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BidController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PageController::class, 'index'])->name('home');
Route::get('/search', [PageController::class,'search']);

Route::name('auth.')->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
    Route::post('/login', [AuthController::class, 'login'])->name('login');

    Route::get("/auth/{provider}/redirect", [SocialAuthController::class, 'redirect']);
    Route::get("/auth/{provider}/callback", [SocialAuthController::class, 'callback']);

    Route::get('/register', [AuthController::class, 'registerForm'])->name('registerForm');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::resource('auctions', AuctionController::class);

Route::post('/auctions/{auctionId}/bidders', [BidController::class, 'placeBid']);