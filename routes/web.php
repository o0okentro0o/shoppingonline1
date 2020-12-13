<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CustomerController;

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

Route::get('/', function () {
    return view('welcome');
    return redirect('customer/home');
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'home']);
    Route::get('/home', [AdminController::class, 'home']);
    Route::get('/login', [AdminController::class, 'login']);
    Route::post('/login', [AdminController::class, 'login']);
    Route::get('/logout', [AdminController::class, 'logout']);
    Route::get('/listcategory', [AdminController::class, 'listcategory']);
    Route::post('/addcategory', [AdminController::class, 'addcategory']);
    Route::post('/updatecategory', [AdminController::class, 'updatecategory']);
    Route::post('/deletecategory', [AdminController::class, 'deletecategory']);
    Route::get('/listproduct', [AdminController::class, 'listproduct']);
    Route::post('/addproduct', [AdminController::class, 'addproduct']);
    Route::post('/updateproduct', [AdminController::class, 'updateproduct']);
    Route::post('/deleteproduct', [AdminController::class, 'deleteproduct']);
    Route::get('/listorder', [AdminController::class, 'listorder']);
    Route::get('/updatestatus', [AdminController::class, 'updatestatus']);
    Route::get('/listcustomer', [AdminController::class, 'listcustomer']);
    Route::get('/deactive', [AdminController::class, 'deactive']);
    Route::get('/sendmail', [AdminController::class, 'sendmail']);
});
Route::group(['prefix' => 'customer'], function () {
    Route::get('/', [CustomerController::class, 'home']);
    Route::get('/home', [CustomerController::class, 'home']);
    Route::get('/listproduct', [CustomerController::class, 'listproduct']);
    Route::post('/search', [CustomerController::class, 'search']);
    Route::get('/details', [CustomerController::class, 'details']);
    Route::get('/signup', [CustomerController::class, 'signup']);
    Route::post('/signup', [CustomerController::class, 'signup']);
    Route::get('/verify', [CustomerController::class, 'verify']);
    Route::get('/login', [CustomerController::class, 'login']);
    Route::post('/login', [CustomerController::class, 'login']);
    Route::get('/logout', [CustomerController::class, 'logout']);
    Route::get('/myprofile', [CustomerController::class, 'myprofile']);
    Route::post('/myprofile', [CustomerController::class, 'myprofile']);
    Route::post('/add2cart', [CustomerController::class, 'add2cart']);
    Route::get('/mycart', [CustomerController::class, 'mycart']);
    Route::get('/remove2cart', [CustomerController::class, 'remove2cart']);
    Route::get('/checkout', [CustomerController::class, 'checkout']);
    Route::get('/myorders', [CustomerController::class, 'myorders']);
});
?>