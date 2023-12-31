<?php

use App\Http\Controllers\AuctionController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
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
Route::get('/search', [PageController::class, 'search']);
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::patch('/profile/address', [ProfileController::class, 'updateAddress'])->name('profile.updateAddress');
}); //sementara doang, harusnya make "id"

Route::get('/wishlist', [ProfileController::class, 'wishlist']);

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'loginForm'])->name('auth.loginForm');
    Route::post('/login', [AuthController::class, 'login'])->name('auth.login');

    Route::get("/auth/{provider}/redirect", [SocialAuthController::class, 'redirect']);
    Route::get("/auth/{provider}/callback", [SocialAuthController::class, 'callback']);

    Route::get('/register', [AuthController::class, 'registerForm'])->name('auth.registerForm');
    Route::post('/register', [AuthController::class, 'register'])->name('auth.register');

});
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');

Route::resource('auctions', AuctionController::class);

Route::post('/auctions/{auctionId}/close', [AuctionController::class, 'closeAuction'])->name('auctions.closeAuction');
Route::post('/auctions/{auctionId}/bidders', [BidController::class, 'placeBid'])->name('bids.placeBid');
Route::get('/auctions/{auctionId}/checkout', [AuctionController::class, 'checkout'])->name('auctions.checkout');
Route::post('/auctions/{auctionId}/buy-now', [AuctionController::class, 'buyNow'])->name('auctions.buyNow');
Route::post('/auctions/{auctionId}/wishlist', [AuctionController::class, 'wishlist'])->name('auctions.wishlist');
