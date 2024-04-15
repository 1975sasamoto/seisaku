<?php

use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/login', [AccountController::class,'showLogin'])->name('login'); // ログイン画面を表示
Route::post('/login', [AccountController::class,'doLogin'])->name('account.doLogin'); // ログイン処理
Route::post('/logout', [AccountController::class,'doLogout'])->name('logout'); // ログアウト処理

route::get('/account/create', [AccountController::class,'create'])->name('account.create'); // ユーザー登録画面を表示
route::post('/account/store', [AccountController::class,'store'])->name('account.store'); // ユーザー登録処理

// ログインしている場合
Route::middleware('auth')->group(function () {
    Route::get('/home/{id?}', [App\Http\Controllers\HomeController::class, 'index']);

    //商品検索
    Route::get('/search/index', [App\Http\Controllers\SearchController::class, 'index']);
    Route::get('/search/detail/{id}', [App\Http\Controllers\SearchController::class, 'detail']);
    
});
// 管理者の場合
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/item/create', [App\Http\Controllers\ItemController::class, 'create'])->name('items'); // 商品登録画面を表示
    Route::get('/item/management', [App\Http\Controllers\ItemController::class, 'management'])->name('managements'); //登録商品一覧画面を表示
    Route::post('/item', [App\Http\Controllers\ItemController::class, 'register'])->name('item'); //商品登録処理
    Route::post('/item/destroy/{id}', [App\Http\Controllers\ItemController::class, 'destroy'])->name('destroy'); //商品削除処理
    Route::get('/item/edit/{id}', [App\Http\Controllers\ItemController::class, 'edit'])->name('edit'); // 登録商品の編集画面
    Route::post('/item/update', [App\Http\Controllers\ItemController::class, 'update'])->name('update'); //登録商品の更新処理

    Route::get('/user', [App\Http\Controllers\UserController::class, 'index']);//ユーザー一覧を表示
    Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit']);//ユーザー編集画面表示
    Route::post('/user/update', [App\Http\Controllers\UserController::class, 'update']);//ユーザー更新処理
    Route::post('/user/{id}', [App\Http\Controllers\UserController::class, 'delete']); //ユーザー削除処理
});

Route::get('/', function () {
    return redirect('/home');
});
