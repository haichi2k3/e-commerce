<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Frontend\BlogController as FrontendBlogController;
use App\Http\Controllers\Frontend\MemberController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//route member
Route::middleware(['no-login'])->group(function () {
    Route::get('/member/register', [MemberController::class, 'register'])->name('member.register');
    Route::post('/member/register', [MemberController::class, 'create'])->name('member.create');
    Route::get('/member/login', [MemberController::class, 'index'])->name('member.index');
    Route::post('/member/login', [MemberController::class, 'login'])->name('member.login');
});

Route::middleware(['member-login'])->group(function () {
    Route::post('member/logout', [MemberController::class, 'logout'])->name('member.logout');

    Route::get('/product/index', [ProductController::class, 'index'])->name('product.index');
    Route::get('/product-detail/{id}', [ProductController::class, 'detail'])->name('product-detail');
    
    Route::get('/member/blog', [FrontendBlogController::class, 'index'])->name('member.blog');
    Route::get('/member/blog/{id}', [FrontendBlogController::class, 'show'])->name('blog.show');
    Route::post('/blog/rate', [FrontendBlogController::class, 'rate'])->name('blog.rate');
    Route::post('/blog/comment', [FrontendBlogController::class, 'comment'])->name('blog.comment');

    Route::get('/account', [MemberController::class, 'account'])->name('account');
    Route::post('/account/update', [MemberController::class, 'update'])->name('account.update');
    Route::get('/account/my-product', [ProductController::class, 'show'])->name('account.show');
    Route::get('/account/add-product', [ProductController::class, 'add'])->name('account.add-product');
    Route::post('/account/add-product', [ProductController::class, 'insert'])->name('account.insert');
    Route::get('/account/edit-product/{id}', [ProductController::class, 'edit'])->name('account.edit-product');
    Route::post('/account/edit-product/{id}', [ProductController::class, 'update'])->name('account.update-product');
    Route::get('/account/delete/{id}', [ProductController::class, 'delete'])->name('account.delete');
    

    Route::post('/cart/add', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/index', [CartController::class, 'index'])->name('cart.index');
    Route::match(['get', 'post'], '/cart/qty', [CartController::class, 'cartQty'])->name('cart.qty');
    Route::match(['get', 'post'], '/cart/delete', [CartController::class, 'cartDelete'])->name('cart.delete');
    Route::get('/cart/checkout/', [CartController::class, 'order'])->name('cart.order');
    Route::post('/cart/checkout/', [CartController::class, 'checkout'])->name('cart.checkout');
    
    Route::get('/send-email', [MailController::class, 'index'])->name('send-email');
    Route::post('/checkout/register', [MailController::class, 'register'])->name('checkout.register');
    
    Route::get('/product/search', [ProductController::class, 'search'])->name('search.items');
    Route::get('/product/search-advanced', [ProductController::class, 'searchAdvancedIndex'])->name('search.advanced-index');
    Route::post('/filter-products', [ProductController::class, 'sliderPrice'])->name('filter-products');
});

//route admin
Route::middleware(['admin-login'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [UserController::class, 'index'])->name('profile.index');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
    
    Route::get('/country', [CountryController::class, 'index'])->name('country.index');
    Route::get('/country/add', [CountryController::class, 'add'])->name('country.add');
    Route::post('/country/add', [CountryController::class, 'insert'])->name('country.insert');
    Route::get('/country/delete/{id}', [CountryController::class, 'delete'])->name('country.delete');
    
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/add', [BlogController::class, 'add'])->name('blog.add');
    Route::post('/blog/add', [BlogController::class, 'insert'])->name('blog.insert');
    Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');
    Route::post('/blog/edit/{id}', [BlogController::class, 'update'])->name('blog.update');
    Route::get('/blog/delete/{id}', [BlogController::class, 'delete'])->name('blog.delete');

    Route::get('/brand', [BrandController::class, 'index'])->name('brand.index');
    Route::get('/brand/add', [BrandController::class, 'add'])->name('brand.add');
    Route::post('/brand/add', [BrandController::class, 'insert'])->name('brand.insert');
    Route::get('/brand/delete/{id}', [BrandController::class, 'delete'])->name('brand.delete');

    Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
    Route::get('/category/add', [CategoryController::class, 'add'])->name('category.add');
    Route::post('/category/add', [CategoryController::class, 'insert'])->name('category.insert');
    Route::get('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
    
    Route::post('/logout', [UserController::class, 'logout'])->name('logout');
});
Auth::routes();