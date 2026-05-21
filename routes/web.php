<?php
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\CustomCakeController;
use App\Http\Controllers\CheckoutController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/all-categories', [HomeController::class, 'allCategories'])->name('categories.all');
Route::get('/all-products', [HomeController::class, 'products'])->name('products');
Route::get('/about-us', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');

Route::get('/products-partial', [HomeController::class, 'productsPartial'])->name('products.partial');
Route::get('/product/{slug}', [HomeController::class, 'productDetails'])->name('product.details');
Route::post('/cart/add/{id}', [CartController::class, 'addToCart'])->name('cart.add');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

Route::delete('/remove-from-cart', [App\Http\Controllers\CartController::class, 'remove'])->name('remove.from.cart');

// Quantity barhane/kam karne ke liye
Route::patch('/update-cart', [App\Http\Controllers\CartController::class, 'update'])->name('update.cart');


// 1. Checkout Page dikhane ke liye (GET)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');

// 2. Order Database mein save karne ke liye (POST)
Route::post('/place-order', [CheckoutController::class, 'store'])->name('order.store');
// 3. Order success hone ke baad ka page (Optional)
Route::get('/order-success/{id}', [CheckoutController::class, 'success'])->name('order.success');
// 4. Variation update karne ka route
Route::patch('/update-variation', [CartController::class, 'updateVariation'])->name('update.variation');


Route::get('/customize-cake', [CustomCakeController::class, 'index'])->name('custom-cake.index');
Route::post('/customize-cake', [CustomCakeController::class, 'store'])->name('custom-order.store');
Route::post('/contact/submit', [MailController::class, 'submitForm'])->name('contact.submit');
