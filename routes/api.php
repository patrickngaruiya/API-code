<?php
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;





//protected routes

Route::group(['middleware'=>['auth:sanctum']], function () {
    Route::post('/products',[ProductController::class,'store']); 
    Route::put('/products/{id}',[ProductController::class,'update']);
    Route::delete('/products/{id}',[ProductController::class,'destroy']);
    Route::post('/logout',[ProductController::class,'logout']);




//unprotected routes

Route::post('/register',[UserController::class,'register']); 
Route::post('/signin',[UserController::class,'signin']); 
Route::get('/products',[ProductController::class,'index']);
Route::get('/products/{id}',[ProductController::class,'show']);
Route::get('/products/search/{name}',[ProductController::class,'search']);




});  
//pagination
 Route::get('/products',function(){ 
    $products= DB::table('products')->simplePaginate(5);
 });





Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
