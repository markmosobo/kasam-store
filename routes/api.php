<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SupplierController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\ListController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProfileController;
use App\Http\Controllers\Api\ActivityController;
use App\Http\Controllers\Api\ProductHistoryController;
use App\Http\Controllers\Api\UserHistoryController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\TaxTotController;
use App\Http\Controllers\Api\AboutInfoController;

Route::group(['prefix' => 'v1', 'middleware' => 'auth:api'], function(){
    Route::get('/user', function( Request $request ){
      return $request->user();
    });
// Route::get('mypurchases/{id}',[PurchaseController::class,'myPurchases']);
// Route::get('myrevenue/{id}',[PurchaseController::class,'myRevenue']);


    
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('categories',CategoryController::class);
Route::apiResource('suppliers',SupplierController::class);
Route::apiResource('products',ProductController::class);
Route::apiResource('purchases',PurchaseController::class);
Route::apiResource('users',UserController::class);
Route::get('lists',[ListController::class, 'index']);
Route::post('restockproducts/{id}',[ProductController::class, 'restock']);
//just reduces pieces
Route::put('reduceproductpieces/{id}',[ProductController::class,'reducePieces']);
//reduces cartpieces after invoice
Route::put('reducecartpieces/{id}',[ProductController::class,'reduceCartPieces']);
Route::put('profile/{id}',[ProfileController::class, 'update']);
Route::put('changepassword/{id}',[ProfileController::class, 'changePassword']);
Route::get('activities/{id}',[ActivityController::class,'activities']);
Route::get('useractivities/{id}',[ActivityController::class,'userActivity']);
Route::get('mypurchases/{id}',[PurchaseController::class,'myPurchases']);
Route::get('myrevenue/{id}',[PurchaseController::class,'myRevenue']);
Route::post('login', [AuthController::class, 'login'])->name('login');
// Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::get('userpurchases',[PurchaseController::class,'userPurchases']);
Route::get('userrevenue',[PurchaseController::class,'userRevenue']);

Route::get('producthistory/{id}',[ProductHistoryController::class,'index']);
Route::get('productsale/{id}',[PurchaseController::class,'productSales']);
Route::get('productrevenue/{id}',[PurchaseController::class,'productRevenue']);
Route::get('productrestock/{id}',[ProductController::class,'productRestock']);

Route::get('userhistory/{id}',[UserHistoryController::class,'index']);
Route::get('userpurchases/{id}',[PurchaseController::class,'userPurchases']);
Route::get('userrevenue/{id}',[PurchaseController::class,'userRevenue']);

Route::get('get-cart', [CartController::class, 'getCart'])->name('cart.list');
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove-from-cart', [CartController::class, 'removeFromCart'])->name('cart.remove');
Route::post('clear-cart', [CartController::class, 'clearAllCart'])->name('cart.clear');

//related to the carts table that stores all carts
Route::post('carts', [CartController::class, 'store']);
Route::post('invoices', [InvoiceController::class, 'store']);
Route::get('invoice/{id}', [InvoiceController::class, 'single']);
Route::get('/search/similar-data', [CartController::class, 'searchSimilarData']);

//tot taxation APIs
Route::put('taxtot/{id}', [TaxTotController::class, 'update']);
Route::get('taxtot/{id}', [TaxTotController::class, 'single']);

Route::put('aboutinfo/{id}', [AboutInfoController::class, 'update']);
Route::get('aboutinfo/{id}', [AboutInfoController::class, 'single']);