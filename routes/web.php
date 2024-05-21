<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/welcome', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';





use App\Http\Controllers\SneakerController;

Route::resource('sneakers', SneakerController::class);
// This code sets up a full set of RESTful routes for the SneakerController:
//     GET /sneakers: index
//     POST /sneakers: store
//     GET /sneakers/{sneaker}: show
//     PUT /sneakers/{sneaker}: update
//     DELETE /sneakers/{sneaker}: destroy


use App\Http\Controllers\CategoryController;

Route::resource('categories', CategoryController::class);
// GET /categories: index
// POST /categories: store
// GET /categories/{category}: show
// PUT /categories/{category}: update
// DELETE /categories/{category}: destroy

use App\Http\Controllers\ReviewController;

Route::resource('reviews', ReviewController::class);
// This route will define the following RESTful routes for the ReviewController:
// GET /reviews: index
// POST /reviews: store
// GET /reviews/{review}: show
// PUT /reviews/{review}: update
// DELETE /reviews/{review}: destroy

// use App\Http\Controllers\CartController;

// Route::resource('cart', CartController::class);
// This route will define the following RESTful routes for the CartController:
// GET /cart: index
// POST /cart: store
// PUT /cart/{cartItem}: update
// DELETE /cart/{cartItem}: destroy
// DELETE /cart: removeAllFromCart


use App\Http\Controllers\OrderController;

Route::post('orders', [OrderController::class, 'store']);
// This route will define the following RESTful route for the OrderController:
// POST /orders: store


use App\Http\Controllers\BrandController;

Route::resource('brands', BrandController::class);
// This route will define the following RESTful routes for the BrandController:
// GET /brands: index
// POST /brands: store
// GET /brands/{brand}: show
// PUT /brands/{brand}: update
// DELETE /brands/{brand}: destroy


use App\Http\Controllers\AdminDashboardController;

Route::get('admin-dashboard', [AdminDashboardController::class, 'index']);

Route::get('admin-dashboard/top-selling-sneakers', [AdminDashboardController::class, 'topSellingSneakers']);

Route::get('admin-dashboard/top-spending-users', [AdminDashboardController::class, 'topSpendingUsers']);


use App\Http\Controllers\SlideshowController;

// Routes for managing slideshows
Route::get('/admin/slideshows', [SlideshowController::class, 'index'])->name('admin.slideshows.index');
Route::get('/admin/slideshows/create', [SlideshowController::class, 'create'])->name('admin.slideshows.create');
Route::post('/admin/slideshows', [SlideshowController::class, 'store'])->name('admin.slideshows.store');
Route::get('/admin/slideshows/{slideshow}/edit', [SlideshowController::class, 'edit'])->name('admin.slideshows.edit');
Route::put('/admin/slideshows/{slideshow}', [SlideshowController::class, 'update'])->name('admin.slideshows.update');
Route::delete('/admin/slideshows/{slideshow}', [SlideshowController::class, 'destroy'])->name('admin.slideshows.destroy');

// Routes for managing brands
Route::get('/admin/brands', [BrandController::class, 'index'])->name('admin.brands.index');
Route::get('/admin/brands/create', [BrandController::class, 'create'])->name('admin.brands.create');
Route::post('/admin/brands', [BrandController::class, 'store'])->name('admin.brands.store');
Route::get('/admin/brands/{brand}/edit', [BrandController::class, 'edit'])->name('admin.brands.edit');
Route::put('/admin/brands/{brand}', [BrandController::class, 'update'])->name('admin.brands.update');
Route::delete('/admin/brands/{brand}', [BrandController::class, 'destroy'])->name('admin.brands.destroy');


// Categories Routes
Route::prefix('admin/categories')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('/', [CategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
});



// web.php

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('sneakers', SneakerController::class);
    Route::get('sneakers/{sneaker}/add-size', [SneakerController::class, 'addSize'])->name('sneakers.add-size');
    Route::get('sneakers/{sneaker}/add-color', [SneakerController::class, 'addColor'])->name('sneakers.add-color');
    Route::get('sneakers/{sneaker}/add-category', [SneakerController::class, 'addCategory'])->name('sneakers.add-category');
    Route::post('sneakers/{sneaker}/store-size', [SneakerController::class, 'storeSize'])->name('sneakers.store-size');
    Route::post('sneakers/{sneaker}/store-color', [SneakerController::class, 'storeColor'])->name('sneakers.store-color');
    Route::post('sneakers/{sneaker}/store-category', [SneakerController::class, 'storeCategory'])->name('sneakers.store-category');
});

Route::get('/sneakers/{id}', [SneakerController::class, 'show'])->name('sneakers.show');
Route::post('/sneakers/{id}/reviews', [SneakerController::class, 'addReview'])->middleware(['auth', 'verified'])->name('sneakers.addReview');
Route::delete('/reviews/{id}', [SneakerController::class, 'deleteReview'])->name('reviews.delete');
Route::delete('/admin/sneakers/{sneaker}', [SneakerController::class, 'destroy'])->name('admin.sneakers.destroy');
// routes/web.php


// Route::prefix('sneakers')->name('sneakers.showAll')->group(function () {
    Route::get('all/sneakers', [SneakerController::class, 'indexAll'])->name('sneakers.showAll.all');
    Route::get('all/sneakers/brand/{brand}', [SneakerController::class, 'filterByBrand'])->name('sneakers.showAll.brand');
    Route::get('all/sneakers/category/{category}', [SneakerController::class, 'filterByCategory'])->name('sneakers.showAll.category');
// });




use App\Http\Controllers\CheckoutController;

Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.show');
Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');















use App\Http\Controllers\FeaturedProductController;

Route::prefix('admin')->group(function () {
    Route::get('featured_products', [FeaturedProductController::class, 'index'])->name('admin.featured_products.index');
    Route::get('featured_products/create', [FeaturedProductController::class, 'create'])->name('admin.featured_products.create');
    Route::post('featured_products', [FeaturedProductController::class, 'store'])->name('admin.featured_products.store');
    Route::get('featured_products/{featured_product}/edit', [FeaturedProductController::class, 'edit'])->name('admin.featured_products.edit');
    Route::put('featured_products/{featured_product}', [FeaturedProductController::class, 'update'])->name('admin.featured_products.update');
    Route::delete('featured_products/{featured_product}', [FeaturedProductController::class, 'destroy'])->name('admin.featured_products.destroy');
});

use App\Http\Controllers\TopCategoryController;

Route::prefix('/admin')->group(function () {
    Route::get('/top_categories', [TopCategoryController::class, 'index'])->name('admin.top_categories.index');
    Route::get('/top_categories/create', [TopCategoryController::class, 'create'])->name('admin.top_categories.create');
    Route::post('/top_categories', [TopCategoryController::class, 'store'])->name('admin.top_categories.store');

    Route::get('/top_categories/{topCategory}/edit', [TopCategoryController::class, 'edit'])->name('admin.top_categories.edit');
    Route::put('/top_categories/{topCategory}', [TopCategoryController::class, 'update'])->name('admin.top_categories.update');

    Route::delete('/top_categories/{topCategory}', [TopCategoryController::class, 'destroy'])->name('admin.top_categories.destroy');
});



use App\Http\Controllers\CartController;

Route::get('/carts', [CartController::class, 'index'])->name('carts.index');
Route::get('/carts/create', [CartController::class, 'create'])->name('carts.create');
Route::post('/carts', [CartController::class, 'store'])->name('carts.store');
Route::get('/carts/{cart}', [CartController::class, 'show'])->name('carts.show');
Route::get('/carts/{cart}/edit', [CartController::class, 'edit'])->name('carts.edit');
Route::put('/carts/{cart}', [CartController::class, 'update'])->name('carts.update');

Route::get('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart/addHome', [CartController::class, 'addToCartFromHome'])->name('cart.addHome');
Route::post('/cart/addHome', [CartController::class, 'addToCartFromHome'])->name('cart.addHome');

// web.php
Route::delete('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');
// web.php
Route::get('/cart/count', [CartController::class, 'getCartCount'])->name('cart.count');

Route::delete('/carts/{cart}', [CartController::class, 'destroy'])->name('carts.destroy');

Route::get('/carts', [CartController::class, 'index'])->name('carts.index');

Route::post('/cart/clear', [CartController::class, 'clearCart'])->name('cart.clear');

