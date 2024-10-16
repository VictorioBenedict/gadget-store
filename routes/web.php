<?php

use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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
Route::get('/smartphone',[PostController::class,'smartphone'])->name('smartphone');
Route::get('/digitalcamera',[PostController::class,'digitalcamera'])->name('digitalcamera');
Route::get('/personalcomputer',[PostController::class,'personalcomputer'])->name('personalcomputer');
Route::get('/television',[PostController::class,'television'])->name('television');
Route::get('/',[PostController::class,'main'])->name('main');

Route::get('/register',[UserController::class,'register'])->name('register');
Route::post('/registers', [UserController::class, 'registers'])->name('registers');
Route::get('/login',[UserController::class,'login'])->name('login');
Route::post('/loginpost',[UserController::class,'loginpost'])->name('loginpost');
Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('/index',[PostController::class,'index'])->name('index')->middleware(['auth','order']);
Route::get('/view/{id}',[PostController::class,'view'])->name('view');
Route::get('/create',[PostController::class,'create'])->name('create');
Route::post('/store',[PostController::class,'store'])->name('store');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('edit');
Route::put('/posts/{id}/update', [PostController::class, 'update'])->name('update');
Route::delete('/delete/{id}', [PostController::class, 'destroy'])->name('destroy');

Route::get('cart', [PostController::class,'cart'])->name('cart')->middleware(['auth','order']);
Route::get('/addtocart/{id}', [PostController::class,'addtocart'])->name('addtocart')->middleware(['auth','order']);
Route::delete('/cart/{id}', [PostController::class,'remove'])->name('remove')->middleware(['auth','order']);
Route::post('/cart/{id}/update-quantity', [PostController::class,'updatequantity'])->name('updatequantity')->middleware(['auth','order']);
Route::get('/order',[PostController::class,'order'])->name('order')->middleware(['auth','order']);
Route::get('/orderlist',[PostController::class,'orderlist'])->name('orderlist')->middleware(['auth','order']);
Route::get('/customer',[PostController::class,'customer'])->name('customer')->middleware(['auth','order']);
Route::get('/customerview/{id}',[PostController::class,'customerview'])->name('customerview')->middleware(['auth','order']);
Route::put('/order-status/{id}', [PostController::class,'updatestatus'])->name('updatestatus');


Route::post('/session', [PostController::class, 'session'])->name('session')->middleware(['auth','order']);
Route::get('/checkout', [PostController::class, 'checkout'])->name('checkout')->middleware(['auth','order']);
Route::get('/success', [PostController::class, 'success'])->name('success')->middleware(['auth','order']);
Route::delete('/truncate', [PostController::class, 'truncateOrders'])->name('truncate');

Route::delete('/cancelorders', [PostController::class, 'cancelorders'])->name('cancelorders')->middleware(['auth','order']);;
Route::delete('/deleteorders/{id}', [PostController::class, 'deleteorders'])->name('deleteorders')->middleware(['auth']);


Route::get('admin', [UserController::class,'admin'])->name('admin');
Route::get('/dashboard',[PostController::class,'dashboard'])->name('dashboard')->middleware(['auth']);

Route::get('/products', [ProductController::class, 'products'])->name('products');
Route::get('/products/television', [ProductController::class, 'televisionn'])->name('televisionn');
Route::get('/products/smartphone', [ProductController::class, 'smartphonee'])->name('smartphonee');
Route::get('/products/digitalcamera', [ProductController::class, 'digitalcameraa'])->name('digitalcameraa');
Route::get('/products/personalcomputer', [ProductController::class, 'personalcomputerr'])->name('personalcomputerr');
Route::get('/products/all', [ProductController::class, 'all'])->name('all');

Route::get('/users',[UserController::class, 'users'])->name('users');
Route::get('/admins',[UserController::class, 'admins'])->name('admins');
Route::get('/add-user',[UserController::class, 'adduser'])->name('add-user');
Route::get('/edit-user/{id}',[UserController::class, 'edituser'])->name('edit-user');
Route::put('/update-user/{id}', [UserController::class, 'updateuser'])->name('update-user');
Route::delete('/delete-user/{id}', [UserController::class, 'deleteuser'])->name('delete-user');
Route::post('/add',[UserController::class, 'add'])->name('add');

Route::get('/adminregister',[UserController::class, 'adminreg'])->name('adminregister');
Route::post('/registerpost',[UserController::class,'registerpost'])->name('registerpost');
Route::put('/updateprofile/{id}', [UserController::class, 'updateprofile'])->name('updateprofile');

Route::get('reset-password', [ResetPasswordController::class, 'resetpassword'])->name('reset-password');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('reset');



Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::get('/searchuser', [ProductController::class, 'searchuser'])->name('searchuser');
Route::get('/searchadmin', [ProductController::class, 'searchadmin'])->name('searchadmin');

Route::get('/export-products', [ProductController::class, 'export'])->name('export');
