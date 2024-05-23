<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FeaturedProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterSubscriptionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SlideshowController;
use App\Http\Controllers\SneakerController;
use App\Http\Controllers\TopCategoryController;
use Illuminate\Support\Facades\Route;

// Home and Welcome Routes
Route::get('/', [HomeController::class, 'index'])->name('home');

// Dashboard Route
Route::get('/dashboard/{sneaker_id?}', [AdminDashboardController::class, 'index'])->name('dashboard');

// Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';

// Admin Routes
Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified'])->group(function () {
    // Slideshow Routes
    Route::resource('slideshows', SlideshowController::class);

    // Brand Routes
    Route::resource('brands', BrandController::class);

    // Category Routes
    Route::resource('categories', CategoryController::class);

    // Sneaker Routes
    Route::resource('sneakers', SneakerController::class);
    Route::get('sneakers/{sneaker}/add-size', [SneakerController::class, 'addSize'])->name('sneakers.add-size');
    Route::get('sneakers/{sneaker}/add-color', [SneakerController::class, 'addColor'])->name('sneakers.add-color');
    Route::get('sneakers/{sneaker}/add-category', [SneakerController::class, 'addCategory'])->name('sneakers.add-category');
    Route::post('sneakers/{sneaker}/store-size', [SneakerController::class, 'storeSize'])->name('sneakers.store-size');
    Route::post('sneakers/{sneaker}/store-color', [SneakerController::class, 'storeColor'])->name('sneakers.store-color');
    Route::post('sneakers/{sneaker}/store-category', [SneakerController::class, 'storeCategory'])->name('sneakers.store-category');
    
    // Featured Product Routes
    Route::resource('featured_products', FeaturedProductController::class);

    // Top Category Routes
    Route::resource('top_categories', TopCategoryController::class);
});

// Public Sneaker Routes
Route::get('/sneakers/{id}', [SneakerController::class, 'show'])->name('sneakers.show');
Route::get('all/sneakers', [SneakerController::class, 'indexAll'])->name('sneakers.showAll.all');
Route::get('all/sneakers/brand/{brand}', [SneakerController::class, 'filterByBrand'])->name('sneakers.showAll.brand');
Route::get('all/sneakers/category/{category}', [SneakerController::class, 'filterByCategory'])->name('sneakers.showAll.category');
Route::post('/sneakers/{id}/reviews', [SneakerController::class, 'addReview'])->middleware(['auth', 'verified'])->name('sneakers.addReview');
Route::delete('/reviews/{id}', [SneakerController::class, 'deleteReview'])->name('reviews.delete');

// Cart Routes
Route::prefix('cart')->group(function () {
    Route::post('/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::post('/addHome', [CartController::class, 'addToCartFromHome'])->name('cart.addHome');
    Route::get('/addHome', [CartController::class, 'addToCartFromHome'])->name('cart.addHome');
    Route::delete('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::post('/clear', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/count', [CartController::class, 'getCartCount'])->name('cart.count');
});

Route::resource('carts', CartController::class);

// Checkout Routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/checkout', [CheckoutController::class, 'showCheckoutForm'])->name('checkout.show');
    Route::post('/checkout', [CheckoutController::class, 'processCheckout'])->name('checkout.process');
    Route::get('/order-confirmation', [CheckoutController::class, 'showOrderConfirmation'])->name('order.confirmation');
});

// Newsletter Subscription Route
Route::post('/newsletter-subscription', [NewsletterSubscriptionController::class, 'store'])->name('newsletter.subscription');

// Static Pages Routes
Route::view('/about-us', 'pages.about')->name('about.us');
Route::view('/contact-us', 'pages.contact')->name('contact.us');
