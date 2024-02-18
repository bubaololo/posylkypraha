<?php

use App\Http\Controllers\BuyNowController;
use App\Http\Controllers\ParcelController;
use App\Http\Controllers\CredentialController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MockCartController;
use App\Http\Controllers\OrderController;
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
Route::get('parcel', [ParcelController::class, 'index'])->name('parcel');
Route::post('checkout', [ParcelController::class, 'store'])->name('cart.checkout');
Route::post('clear', [ParcelController::class, 'clearAllCart'])->name('cart.clear');
Route::post('delivery', [DeliveryCostController::class, 'getDeliveryCost'])->name('cdek');


Route::get('profile',[ProfileController::class, 'index'])->name('profile');

Route::get('test', [MockCartController::class, 'store'])->name('cart.mock');

//Route::get('/', [MainPageController::class, 'index'])->name('index'); // TODO найти где ещё есть обращение к имени роута и изменить его

Route::get('/', function() {
    return redirect('/parcel');
})->name('index');

Route::get('/switchLang/{lang}', [LanguageController::class, 'switchLang']);

Auth::routes();

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');

Route::get('/order/{id}', [ProfileController::class, 'order'])->name('order.details');

Route::resource('credentials', CredentialController::class);
Route::get('articles', [ArticleController::class, 'postsList'])->name('posts.list');
Route::get('{slug}', [ArticleController::class, 'show'])->name('post');

