<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ContactController;

Route::get('/', function () {
    return view('welcome');
});
// 商品一覧画面の表示
Route::get('/index', [ProductController::class, 'index'])->name('index');
// 商品新規登録画面の表示
Route::get('/create', [ProductController::class, 'create'])->name('create');
// 商品の登録処理
Route::post('/store', [ProductController::class, 'store'])->name('store');
// 出品商品の詳細画面を表示
Route::get('/listing/{id}', [ProductController::class, 'show'])->name('listing.detail');
// 出品商品の更新画面を表示
Route::get('/product/{id}/listing_edit', [ProductController::class, 'listing_edit'])->name('listing.edit');
// 商品の更新処理
Route::put('/product/{id}', [ProductController::class, 'update'])->name('update');
// 商品の検索処理
Route::get('/search', [ProductController::class, 'search'])->name('search');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// マイページを表示
Route::get('/mypage', [ProductController::class, 'mypage'])->name('mypage');
// 削除機能
Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('destroy');
// 商品詳細を表示
Route::get('/product/{id}', [ProductController::class, 'product_detail'])->name('product.detail');
// アカウント編集画面を表示
Route::get('/account/edit', [UserController::class, 'edit'])->name('account.edit')->middleware('auth');
// アカウント情報の更新処理
Route::post('/account/update', [UserController::class, 'update'])->name('account.update')->middleware('auth');

// 購入画面を表示
Route::get('/purchase/{id}', [ProductController::class, 'showPurchase'])->name('purchase.show');
// 購入処理
Route::post('/purchase', [ProductController::class, 'purchase'])->name('purchase');

// いいね追加
Route::post('/products/{product}/like', [LikeController::class, 'likeProduct'])->middleware('auth');
// いいね削除
Route::delete('/products/{product}/like', [LikeController::class, 'unlikeProduct'])->middleware('auth');

// 問い合わせフォーム画面
Route::get('/contact', [ContactController::class, 'showContact'])->name('contact.form');

// 問い合わせフォーム送信
Route::post('/contact', [ContactController::class, 'submitForm'])->name('contact.submit');
