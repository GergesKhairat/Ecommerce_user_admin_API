<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
//authentication ===========>>>>>>>> passport || sanctum
//user_defined authentication=>access token
Route::middleware('api_auth')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get("products", "index");
        Route::get("products/show/{id}", "show");
        Route::post("products/store", "store");
        Route::put("products/update/{id}", "update");
        Route::delete("products/delete/{id}", "destroy");
        Route::post("logout", [AuthController::class, "logout"]);
    });
});

Route::controller(AuthController::class)->group(function () {
    Route::post("register", "register");
    Route::post("login", "login");
});
