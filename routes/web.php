<?php

use App\Http\Controllers\authController;
use App\Http\Controllers\cartController;
use App\Http\Controllers\catController;
use App\Http\Controllers\homeController;
use App\Http\Controllers\itemController;
use App\Http\Controllers\reportController;
use App\Http\Controllers\socialiteController;
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
define('PAGINATION_COUNT',3);

Route::get('/', function () {return view('welcome');});

Route::get('/index',[homeController::class,'index']);
Route::get('/search',[homeController::class,'search']);

Route::post('/cart',[cartController::class,'cart']);
Route::get('/myCart',[cartController::class,'myCart']);
Route::get('/remove/{rowId}',[cartController::class,'remove']);

/* guest */

Route::middleware('guest')->group(function (){

    Route::get('/signup', function () {return view('signUp');});
    Route::post('/signAction',[authController::class,'register']);
    Route::get('account/verify/{token}', [authController::class, 'verifyAccount'])->name('user.verify'); 
    Route::get('/login', function () {return view('sign');});
    Route::post('/loginAction',[authController::class,'login']);
    Route::get('/redirect/{service}',[socialiteController::class,'redirect']);
    Route::get('/callback/{service}',[socialiteController::class,'callback']);
    Route::get('/forget', function () {return view('forget');});

});

/* auth */

Route::middleware(['auth','admin','is_verify_email'])->group(function (){

    Route::get('/dashboard',[homeController::class,'dashboard']);
    //route Categories
    Route::get('/category',[catController::class,'category']);
    Route::get('/addCat',[catController::class,'add']);
    Route::post('/add',[catController::class,'addAction']);
    Route::get('/updateCat/{id}',[catController::class,'update']);
    Route::post('/update/{id}',[catController::class,'updateAction']);
    Route::get('/deleteCat/{id}',[catController::class,'delete']);

    //category item
    Route::get('/items/{id}',[catController::class,'items']);
    
    //route items
    Route::get('/item',[itemController::class,'health']);
    Route::get('/addItem',[itemController::class,'add']);
    Route::post('/addItemAction',[itemController::class,'addAction']);
    Route::get('/updateItem/{id}',[itemController::class,'update']);
    Route::post('/updateItemAction/{id}',[itemController::class,'updateAction']);
    Route::get('/deleteItem/{id}',[itemController::class,'delete']);

    //ajax 
    Route::get('/itemAjax/{category_id}',[reportController::class,'getItem']);

    //route report table
    Route::get('/report',[reportController::class,'report']);
    Route::get('/addReport',[reportController::class,'add']);
    Route::post('/addReportAction',[reportController::class,'addAction']);
    Route::get('/updateReport/{id}',[reportController::class,'update']);
    Route::post('/updateReportAction/{id}',[reportController::class,'updateAction']);
    Route::get('/deleteReport/{id}',[reportController::class,'delete']);

    //route orders table
    Route::get('/order',[cartController::class,'order']);

});
   

/* checkout */

Route::middleware('auth','is_verify_email')->group(function (){

    Route::get('/checkout/{amount}', [cartController::class, 'checkout']);
    Route::get('/charge', [cartController::class, 'charge'])->name('cart.charge');

    Route::get('/logout',[authController::class,'logout']);

});


/* reset pass */

Route::post('forget-password', [authController::class, 'reset'])->name('password.email');
Route::get('/reset-password/{token}',[authController::class, 'resetView'])->name('password.reset'); 
Route::post('reset-password', [authController::class, 'updatePass'])->name('password.update'); 
// ????
Route::get('account/change/{pass}', [authController::class, 'resetAccount'])->name('user.reset'); 



