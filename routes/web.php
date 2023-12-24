<?php

use App\Http\Controllers\BuyNowController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\MockCartController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\MainPageController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\DeliveryCostController;
use Illuminate\Support\Facades\Route;

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

Route::get('products', [ProductController::class, 'productList'])->name('products.list');
Route::get('product/{slug}', [ProductController::class, 'singleProduct'])->name('single.product');
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::get('cart/{id}', [BuyNowController::class, 'buySpecificProduct'])->name('cart.now');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('checkout', [CartController::class, 'store'])->name('cart.checkout');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');
Route::post('delivery', [DeliveryCostController::class, 'getDeliveryCost'])->name('cdek');


Route::get('profile',[ProfileController::class, 'index'])->name('profile');

Route::get('test', [MockCartController::class, 'store'])->name('cart.mock');

Route::get('/', [MainPageController::class, 'index'])->name('index'); // TODO найти где ещё есть обращение к имени роута и изменить его

Auth::routes();

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/order/{id}', [ProfileController::class, 'order'])->name('order.details');

Route::resource('credentials', CredentialController::class);
Route::get('articles', [ArticleController::class, 'postsList'])->name('posts.list');
Route::get('{slug}', [ArticleController::class, 'show'])->name('post');

