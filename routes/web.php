<?php

use App\Http\Controllers\BannerController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SocialLoginController;
use App\Http\Controllers\StripePaymentController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SubscriberController;
use App\Http\Controllers\TagContrller;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use NunoMaduro\Collision\Adapters\Phpunit\Subscribers\Subscriber;

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

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/', [FrontendController::class, 'welcome'])->name('index');
Route::get('/dashboard', [HomeController::class, 'admin_panel'])->middleware(['auth', 'verified'])->name('admin.panel');
Route::get('/user/logout', [HomeController::class, 'logout'])->name('user.logout');
Route::get('/product/details/{slug}', [FrontendController::class, 'product_details'])->name('product.details');
Route::post('/getSizes', [FrontendController::class, 'getSizes']);
Route::post('/getStock', [FrontendController::class, 'getStock']);
Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::get('/shop', [FrontendController::class, 'shop'])->name('shop');
Route::get('/recent/views', [FrontendController::class, 'recent_views'])->name('recent.views');


/* Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard'); */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//Users
Route::get('/user/edit', [UserController::class, 'user_edit'])->name('user.edit');
Route::post('/user/update', [UserController::class, 'user_update'])->name('user.update');
Route::post('/password/update', [UserController::class, 'password_update'])->name('password.update');
Route::post('/user/photo/update', [UserController::class, 'user_photo_update'])->name('user.photo.update');
Route::get('/user/list', [UserController::class, 'user_list'])->name('user.list');
Route::get('/user/delete/{id}', [UserController::class, 'user_delete'])->name('user.delete');

//Category

//Route::get('/category', [CategoryController::class, 'index'])->name('category.add');
//Route::post('/category', [CategoryController::class, 'add'])->name('category.insert');
//Route::post('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
//Route::post('/category/delete/{deleteid}', [CategoryController::class, 'distroy'])->name('category.distroy');

//Categories--
Route::get('/add/category', [CategoryController::class, 'add_category'])->name('add.category');
Route::POST('/store/category', [CategoryController::class, 'store_category'])->name('store.category');
Route::get('/delete/category/{id}', [CategoryController::class, 'del_category'])->name('delete.category');
Route::get('/edit/category/{id}', [CategoryController::class, 'edit_category'])->name('edit.category');
Route::POST('/update/category/{id}', [CategoryController::class, 'update_category'])->name('update.category');
Route::get('/trash/category', [CategoryController::class, 'trash_category'])->name('trash.category');
Route::get('/restore/category/{id}', [CategoryController::class, 'restore_category'])->name('category.restore');
Route::get('/hard/delete/category/{id}', [CategoryController::class, 'hard_del_category'])->name('hard.delete.category');
Route::post('/check/delete', [CategoryController::class, 'check_delete'])->name('check.delete');
Route::post('/restore/checked', [CategoryController::class, 'restore_checked'])->name('restore.checked');

//Sub Category
Route::get('/subcategory',[SubCategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/subcategory/store',[SubCategoryController::class, 'subcategory_store'])->name('subcategory.store');
Route::get('/edit/subcategory/{id}',[SubCategoryController::class, 'edit_subcategory'])->name('edit.subcategory');
Route::post('/update/subcategory/{id}',[SubCategoryController::class, 'subcategory_update'])->name('subcategory.update');
Route::get('/delete/subcategory/{id}',[SubCategoryController::class, 'delete_subcategory'])->name('delete.subcategory');

//Brand
Route::get('/product/brand', [BrandController::class, 'brand'])->name('brand');
Route::post('/brand/store', [BrandController::class, 'brand_store'])->name('brand.store');
Route::get('/brand/delete/{id}', [BrandController::class, 'brand_delete'])->name('brand.delete');
Route::get('/edit/brand/{id}', [BrandController::class, 'edit_brand'])->name('edit.brand');
Route::post('/update/brand/{id}', [BrandController::class, 'update_brand'])->name('update.brand');
Route::post('/check/delete', [BrandController::class, 'check_delete'])->name('check.delete');



//Tags
Route::get('/product/tags/', [TagContrller::class, 'tags'])->name('tags');
Route::post('/tag/store', [TagContrller::class, 'tag_store'])->name('tag.store');
Route::get('/tag/delete/{id}', [TagContrller::class, 'tag_delete'])->name('tag.delete');
Route::get('/edit/tag/{id}', [TagContrller::class, 'edit_tag'])->name('edit.tag');
Route::post('/update/tag/{id}', [TagContrller::class, 'update_tag'])->name('update.tag');

//Product
Route::get('add/product',[ProductController::class, 'add_product'])->name('add.product');
Route::post('/getsubcategory',[ProductController::class, 'getsubcategory']);
Route::post('/product/store',[ProductController::class, 'product_store'])->name('product.store');
Route::get('/product/list',[ProductController::class, 'product_list'])->name('product.list');
Route::get('/product/view/{id}',[ProductController::class, 'product_view'])->name('product.view');
Route::get('/product/delete/{id}',[ProductController::class, 'product_delete'])->name('product.delete');


//Varriation
Route::get('/add/variation',[InventoryController::class,'add_variation'])->name('add.variation');
Route::post('/color/store',[InventoryController::class,'color_store'])->name('color.store');
Route::post('/size/store',[InventoryController::class,'size_store'])->name('size.store');
Route::get('/size/edit/{id}',[InventoryController::class, 'size_edit'])->name('size.edit');
Route::post('/size/update/{id}',[InventoryController::class, 'size_update'])->name('size.update');
Route::get('/color/delete/{id}',[InventoryController::class,'color_delete'])->name('color.delete');
Route::get('/color/edit/{id}',[InventoryController::class, 'color_edit'])->name('color.edit');
Route::post('/color/update/{id}',[InventoryController::class, 'color_update'])->name('color.update');
Route::get('/inventory/{id}',[InventoryController::class, 'inventory'])->name('inventory');
Route::post('/inventory/store/{id}',[InventoryController::class, 'inventory_store'])->name('inventory.store');
Route::get('/inventory/delete/{id}',[InventoryController::class, 'inventory_delete'])->name('inventory.delete');


//Banner
Route::get('/add/banner',[BannerController::class, 'add_banner'])->name('add.banner');
Route::post('/banner/store',[BannerController::class, 'banner_store'])->name('banner.store');
Route::get('/banner/status/{id}',[BannerController::class, 'banner_status'])->name('banner.status');
Route::get('/banner/delete/{id}',[BannerController::class, 'banner_delete'])->name('banner.delete');

//Subscriber
Route::get('edit/subscriber', [SubscriberController::class, 'subscriber_edit'])->name('edit.subscriber');
Route::post('update/subscribertext/{id}', [SubscriberController::class, 'subtext_update'])->name('subtext.update');
Route::post('subscriber/store', [SubscriberController::class, 'subscriber_store'])->name('subscriber.store');
Route::get('subscriber/delete/{id}', [SubscriberController::class, 'subscriber_delete'])->name('subscriber.delete');

//Customer
Route::get('/customer/login', [CustomerAuthController::class, 'customer_login'])->name('customer.login');
Route::get('/customer/register', [CustomerAuthController::class, 'customer_register'])->name('customer.register');
Route::post('/customer/store', [CustomerAuthController::class, 'customer_store'])->name('customer.store');
Route::post('/customerlogin', [CustomerAuthController::class, 'customerlogin'])->name('customerlogin');
Route::get('/customer/logout', [CustomerAuthController::class, 'customer_logout'])->name('customer.logout');

Route::get('/customer/profile', [CustomerController::class, 'customer_profile'])->name('customer.profile')->middleware('customer_login_check');
Route::post('/customer/info/update', [CustomerController::class, 'customer_update'])->name('customer.info.update');
Route::get('my/order', [CustomerController::class, 'my_order'])->name('my.order');
Route::get('download/invoice/{id}', [CustomerController::class, 'download_invoice'])->name('download.invoice');
Route::get('/customer/email/verify/{token}', [CustomerController::class, 'customer_email_verify'])->name('customer.email.verify');
Route::get('email/verify/req', [CustomerAuthController::class, 'customer_email_verify_req'])->name('customer.email.verify.req');
Route::post('email/verify/req/send', [CustomerAuthController::class, 'email_verify_req_send'])->name('email.verify.req.send');

// Cart

Route::post('/add/to/cart/{product_id}', [CartController::class, 'add_cart'])->name('add.cart');
Route::get('/cart/remove/{cart_id}', [CartController::class, 'cart_remove'])->name('cart.remove');
Route::post('/cart/update', [CartController::class, 'cart_update'])->name('cart.update');

//Coupon
Route::get('/coupon', [CouponController::class, 'coupon'])->name('coupon');
Route::post('/coupon/store', [CouponController::class, 'coupon_store'])->name('coupon.store');
Route::get('/coupon/delete/{id}', [CouponController::class, 'coupon_del'])->name('coupon.del');

//checkout
Route::post('/getcity', [CheckoutController::class, 'getcity']);
Route::post('/order/confirm', [CheckoutController::class, 'order_confirm'])->name('order.confirm');
Route::get('/order/success', [CheckoutController::class, 'order_success'])->name('order.success');

//Stripe
Route::controller(StripePaymentController::class)->group(function(){
    Route::get('stripe', 'stripe')->name('stripe');
    Route::post('stripe/{$id}', 'stripePost')->name('stripe.post');
});


//orders
Route::get('/orders',[OrderController::class, 'orders'])->name('orders');
Route::post('/change/order/status/{id}',[OrderController::class, 'change_order_status'])->name('change.order.status');
Route::post('review/store/{product_id}',[OrderController::class, 'review_store'])->name('review.store');

//Password Reset
Route::get('/pass/reset/req', [CustomerController::class, 'pass_reset_req'])->name('pass.reset.req');
Route::post('/pass/reset/req/send', [CustomerController::class, 'pass_reset_req_send'])->name('pass.reset.req.send');
Route::get('/pass/reset/form{token}', [CustomerController::class, 'pass_reset_form'])->name('pass.reset.form');
Route::post('/pass/reset/update/{token}', [CustomerController::class, 'pass_reset_update'])->name('pass.reset.update');


//Role
Route::get('/role/manager',[RoleController::class, 'role_manager'])->name('role.manager');
Route::post('/permission/store',[RoleController::class, 'permission_store'])->name('permission.store');
Route::post('/add/role',[RoleController::class, 'add_role'])->name('add.role');
Route::get('/del/role/{role_id}',[RoleController::class, 'del_role'])->name('del.role');
Route::post('/role/assign',[RoleController::class, 'role_assign'])->name('role.assign');
Route::get('/remove/role/{user_id}',[RoleController::class, 'remove_role'])->name('remove.role');


//Social Login
Route::get('/github/redirect', [SocialLoginController::class, 'github_redirect'])->name('github.redirect');
Route::get('/github/callback', [SocialLoginController::class, 'github_callback'])->name('github.callback');

Route::get('/google/redirect', [SocialLoginController::class, 'google_redirect'])->name('google.redirect');
Route::get('/google/callback', [SocialLoginController::class, 'google_callback'])->name('google.callback');
