<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MainController;

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

//admin routes
Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.index');


Route::get('/dashboard/admin_profile', [AdminController::class, 'adminProfile'])->name('profile.page');

Route::get('/our_customers', [AdminController::class, 'customers'])->name('customers.page');



Route::get('/our_customers/{status}/{id}', [AdminController::class, 'changeUserStatus'])->name('change.status');

Route::get('/orders/{status}/{id}', [AdminController::class, 'changeOrderStatus'])->name('change.order');

Route::get('/our_orders', [AdminController::class, 'allOrders'])->name('order.page');


Route::get('/dashboard/products', [AdminController::class, 'products'])->name('all.products');


Route::get('/dashboard/products/trash', [AdminController::class, 'trashPage'])->name('all.trash');

Route::get('/dashboard/products/trash/{id}', [AdminController::class, 'trash'])->name('trash.product');

Route::get('/dashboard/products/trash/restore/{id}', [AdminController::class, 'restore'])->name('products.restore');
Route::get('/dashboard/products/trash/force_delete/{id}', [AdminController::class, 'forceDelete'])->name('products.delete');

Route::post('/dashboard/upload/product', [AdminController::class, 'upload'])->name('upload.product');
Route::post('/dashboard/product_update/{id}', [AdminController::class, 'updateProduct'])->name('update.product');



//customer routes
Route::get("/", [MainController::class, "index"])->name('main.index');
Route::get("/about", [MainController::class, "about"])->name('main.about');
Route::get("/blog", [MainController::class, "blog"])->name('main.blog');
Route::get("/single_blog", [MainController::class, "singleBlog"])->name('blog.single');
Route::get("/shop", [MainController::class, "shop"])->name('main.shop');
Route::get("/single_shop/{id}", [MainController::class, "singleShop"])->name('single.shop');
Route::get("/shopping_cart", [MainController::class, "cart"])->name('main.cart');

Route::get("/checkout", [MainController::class, "checkout"])->name('main.checkout');
Route::get("/contact", [MainController::class, "contact"])->name('main.contact');
Route::get("/register", [MainController::class, "register"])->name('main.register');
Route::post("/registerUser", [MainController::class, "registerUser"])->name('main.register.user');
Route::get("/signin", [MainController::class, "login"])->name('main.login');
Route::post("/signinUser", [MainController::class, "loginUser"])->name('main.login.user');
Route::get("/logout_User", [MainController::class, "logoutUser"])->name('main.logout.user');

Route::post('/add_cart', [MainController::class, "addCart"])->name('add.cart');

Route::get('/delete_cart/{id}', [MainController::class, "deleteCart"])->name('delete.cart');

Route::post('/update_cart/{id}', [MainController::class, "updateCart"])->name('update.cart');
Route::post('/checkout', [MainController::class, "checkout"])->name('checkout.cart');

Route::post('/payment', [MainController::class, "paymentStripe"])->name('payment.stripe');


Route::get("/myaccount", [MainController::class, "profile"])->name('main.profile');
Route::get("/myorders", [MainController::class, "orders"])->name('profile.orders');
Route::post("/updateUser", [MainController::class, "updateUser"])->name('user.update');

//google login
Route::get('/google/login', [MainController::class, "googleLogin"])->name('google.login');

Route::get('/auth/google/login/callback', [MainController::class, "googleCallback"])->name('google.callback');

