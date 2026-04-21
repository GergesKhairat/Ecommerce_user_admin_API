<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\User\ProductController as UserProductController;
use App\Http\Controllers\WishlistController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, "home"]);

Route::middleware([
    'auth:sanctum',
    'change_lang',
    'is_admin',
    config('jetstream.auth_session'),
    'verified',
])->get("dashboard", [HomeController::class, "home"])->name("home");

Route::middleware('auth', 'is_admin', 'change_lang')->group(function () {
    Route::controller(ProductController::class)->group(function () {
        Route::get("products", "index")->name("admin.products.all");
        Route::get("products/create", "createForm")->name("admin.products.create");
        Route::post("products/store", "store")->name("admin.products.store");
        Route::get("products/edit/{id}", "edit")->name("admin.products.edit");
        Route::put("products/update/{id}", "update")->name("admin.products.update");
        Route::delete("products/delete/{id}", "destroy")->name("admin.products.delete");
    });
});


//language
Route::get("change/{lang}", function ($lang) {
    if ($lang == "en") {
        session()->put("lang", "en");
    } else {
        session()->put("lang", "ar");
    }
    return redirect()->back();
});

//user side
Route::get("products/show/{id}", [UserProductController::class, "show"])->name("user.products.show");
Route::middleware('change_lang')->get("dashboard", [HomeController::class, "home"])->name("home");

Route::middleware('auth', 'change_lang')->group(function () {
    Route::controller(UserProductController::class)->group(function () {
        Route::post("addToCart/{id}", "addToCart")->name("user.addToCart");
        Route::get("cart", "cart")->name("user.cart");
    });
    Route::controller(OrderController::class)->group(function () {
        Route::get('orders', 'index')->name('user.order.all');
        Route::get('orders/{id}', 'show')->name('user.order.show');
        Route::post("makeOrder", "makeOrder")->name("user.makeOrder");
        // Route::get("cart", "cart")->name("user.cart");
    });
    Route::controller(WishlistController::class)->group(function () {
        Route::get('wishlist', 'index')->name('user.wishlist');
        Route::post('wishlist/{id}', 'addToWishlist')->name('user.addToWishlist');
        Route::delete('wishlist/destroy/{id}', 'destroy')->name('user.wishlist.delete');
    });
});
