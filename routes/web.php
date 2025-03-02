<?php

use Illuminate\Support\Facades\Route;

//trang chủ
Route::get('/','App\Http\Controllers\HomeController@index');

Route::get('/visits', [VisitController::class, 'index']);
//hiển thị sản phẩm theo danh mục
//Route::get('danh-muc-san-pham/{slug}','App\Http\Controllers\CategoryController@index')->name('danh_muc_san_pham');

//trang chủ admin page
Route::get('admin','App\Http\Controllers\AdminController@index')->name('admin')->middleware('auth.AdminAndAuthor');

//category
Route::group(['prefix'=>'admin','middleware'=>['auth.AdminAndAuthor']],function()
{
    Route::get('them-danh-muc','App\Http\Controllers\CategoryController@add_category')->name('add_category');
    Route::post('xu-ly-them-danh-muc','App\Http\Controllers\CategoryController@handle_add')->name('handle_add_category');
    Route::get('danh-sach-danh-muc','App\Http\Controllers\CategoryController@list')->name('list_category');
    Route::get('xoa-danh-muc/{id}','App\Http\Controllers\CategoryController@delete')->name('delete_category');
    Route::get('sua-danh-muc/{id}','App\Http\Controllers\CategoryController@edit')->name('edit_category');
    Route::post('xu-ly-sua-danh-muc/{id}','App\Http\Controllers\CategoryController@handle_edit')->name('handle_edit_category');
    Route::get('sua-trang-thai/{id}','App\Http\Controllers\CategoryController@edit_status')->name('edit_status');
}); 

//product
Route::get('them-san-pham','App\Http\Controllers\ProductController@add')->name('add_product')->middleware('auth.AdminAndAuthor');
Route::group(['prefix'=>'admin','middleware'=>['auth.AdminAndAuthor']],function()
{
    //Route::get('them-san-pham','App\Http\Controllers\ProductController@add')->name('add_product');
    Route::post('xu-ly-them-san-pham','App\Http\Controllers\ProductController@handle_add')->name('handle_add_product');
    Route::get('danh-sach-san-pham','App\Http\Controllers\ProductController@list')->name('list_product');
    Route::post('sua-trang-thai-san-pham','App\Http\Controllers\ProductController@edit_status')->name('edit_status_product');
    Route::get('xoa-san-pham/{id}','App\Http\Controllers\ProductController@delete')->name('delete_product');
    Route::get('sua-san-pham/{id}','App\Http\Controllers\ProductController@edit')->name('edit_product');
    Route::post('xu-ly-sua-san-pham','App\Http\Controllers\ProductController@handle_edit')->name('handle_edit_product');
});
Route::get('san-pham/{id}','App\Http\Controllers\ProductController@detail')->name('detail_product');
Route::get('danh-muc-san-pham/{slug}','App\Http\Controllers\ProductController@show_product_with_category')->name('show_product_with_category');
Route::get('them-gallery/{id}','App\Http\Controllers\ProductController@add_gallery')->name('add_gallery');
Route::post('select-gallery','App\Http\Controllers\ProductController@select_gallery')->name('select_gallery');
Route::post('xu-ly-them-gallery','App\Http\Controllers\ProductController@handle_add_image_gallery')->name('handle_add_image_gallery');
Route::post('xoa-gallery','App\Http\Controllers\ProductController@delete_gallery')->name('delete_gallery');
Route::post('thay-doi-anh-gallery','App\Http\Controllers\ProductController@change_image_gallery')->name('change_image_gallery');
Route::get('tim-kiem-san-pham-theo-gia/{type}/{slug}','App\Http\Controllers\ProductController@search_product_with_price')->name('search_product_with_price');
Route::get('tim-kiem-san-pham-theo-so-luong-da-ban/{type}/{slug}','App\Http\Controllers\ProductController@search_product_with_sold')->name('search_product_with_sold');


//cart 
Route::get('gio-hang','App\Http\Controllers\CartController@get_mothod_shopping_cart')->name('get_mothod_shopping_cart');
Route::post('gio-hang','App\Http\Controllers\CartController@shopping_cart')->name('shopping_cart');
Route::post('cap-nhat-gio-hang','App\Http\Controllers\CartController@update')->name('update_cart');
Route::get('xoa-san-pham-trong-gio-hang/{uid}','App\Http\Controllers\CartController@delete_product')->name('delete_product_in_cart');
Route::post('add-cart-ajax','App\Http\Controllers\CartController@add_cart_ajax')->name('add-cart-by-ajax');
Route::get('xoa-tat-ca-san-pham-trong-gio-hang','App\Http\Controllers\CartController@delete_all')->name('delete-all-product-in-cart');
Route::get('dem-san-pham-trong-cart-menu','App\Http\Controllers\CartController@show_cart_menu')->name('show_cart_menu');
Route::get('hover-san-pham-trong-cart-menu','App\Http\Controllers\CartController@hover_cart_menu')->name('hover_cart_menu');

//checkout

Route::get('thanh-toan','App\Http\Controllers\CheckoutController@pay')->name('pay_product');
Route::post('phuong-thuc-thanh-toan','App\Http\Controllers\CheckoutController@payment_method')->name('payment_method');

//order 
Route::group(['prefix'=>'admin','middleware'=>['auth.AdminAndAuthor']],function()
{
    Route::get('danh-sach-don-hang','App\Http\Controllers\OrderController@list_order')->name('list_order');
    Route::get('xoa-don-hang/{orderId}','App\Http\Controllers\OrderController@delete_order')->name('delete_order');
    Route::get('chi-tiet-don-hang/{orderId}','App\Http\Controllers\OrderController@detail_order')->name('detail_order');
    Route::get('tim-kiem-don-hang-theo-keyword','App\Http\Controllers\OrderController@search_in_order')->name('search_in_order');
    Route::get('tim-kiem-don-hang-to-den-nho','App\Http\Controllers\OrderController@down_price_order')->name('down_price_order');
    Route::get('tim-kiem-don-hang-nho-den-to','App\Http\Controllers\OrderController@up_price_order')->name('up_price_order');
    Route::get('tim-kiem-don-hang-theo-status/{status}','App\Http\Controllers\OrderController@search_with_status')->name('search_with_status');
});
Route::post('dat-hang','App\Http\Controllers\OrderController@order_place')->name('order_place');
Route::post('cap-nhat-trang-thai-san-pham-cua-don-hang','App\Http\Controllers\OrderController@update_status_of_order')->name('update_status_of_order');
Route::get('xoa-san-pham-trong-don-hang/{id}/{quantyti}','App\Http\Controllers\OrderController@delete_product_in_order')->name('delete_product_in_order');
Route::post('cap-nhat-so-luong-san-pham-trong-don-hang','App\Http\Controllers\OrderController@update_qty_product_in_order')->name('update_qty_product_in_order');
Route::get('don-hang-cua-toi','App\Http\Controllers\OrderController@my_order')->name('my_order');
Route::get('chi-tiet-don-hang-cua-toi/{id}','App\Http\Controllers\OrderController@detail_my_order')->name('detail_my_order');
Route::post('huy-don-hang','App\Http\Controllers\OrderController@customer_cancel_order')->name('customer_cancel_order');
 


//user người mua hàng
Route::get('thong-tin-tai-khoan','App\Http\Controllers\InfoUserController@show_info')->name('info_user');

//search product
Route::post('tim-kiem-san-pham','App\Http\Controllers\HomeController@search')->name('search_product');
Route::post('tim-kiem-san-pham-autocomplete','App\Http\Controllers\HomeController@autocomplete_search')->name('autocomplete_search');


//coupon
Route::group(['prefix'=>'admin','middleware'=>['auth.AdminAndAuthor']],function()
{
    Route::get('them-ma-giam-gia','App\Http\Controllers\CouponController@insert')->name('insert_coupon');
    Route::post('xu-ly-them-ma-giam-gia','App\Http\Controllers\CouponController@handle_insert')->name('handle_insert_coupon');
    Route::get('danh-sach-ma-giam-gia','App\Http\Controllers\CouponController@list')->name('list_coupon');
    Route::get('sua-ma-giam-gia/{id}','App\Http\Controllers\CouponController@edit')->name('edit_coupon');
    Route::post('xu-ly-sua-ma-giam-gia','App\Http\Controllers\CouponController@handle_edit')->name('handle_edit_coupon');
    Route::get('xoa-ma-giam-gia/{id}','App\Http\Controllers\CouponController@delete')->name('delete_coupon');
    Route::post('doi-trang-thai-coupon}','App\Http\Controllers\CouponController@change_status')->name('change_status');
});
Route::post('giam-gia','App\Http\Controllers\CouponController@discount')->name('discount');

//admin login, register

Route::get('admin/register-auth','App\Http\Controllers\AuthController@register_auth')->name('register');
Route::post('admin/handle-register-auth','App\Http\Controllers\AuthController@handle_register')->name('handle_register_admin');
Route::get('admin/login','App\Http\Controllers\AuthController@login')->name('login_admin');
Route::post('admin/handle-login','App\Http\Controllers\AuthController@handle_login')->name('handle_login');
Route::get('admin/logout','App\Http\Controllers\AuthController@logout')->name('admin_logout');

//user
Route::group(['prefix'=>'admin','middleware'=>['auth.AdminAndAuthor']],function()
{
    Route::get('list-user','App\Http\Controllers\UserController@index')->name('list_user');
    Route::post('assign-roles','App\Http\Controllers\UserController@assign_roles')->name('assign_roles');
    Route::get('delete-user/{id}','App\Http\Controllers\UserController@delete')->name('delete_user');
});
Route::post('thay-doi-avatar','App\Http\Controllers\UserController@user_change_avatar')->name('user_change_avatar');
Route::post('thay-doi-thong-tin-ca-nhan','App\Http\Controllers\UserController@user_change_information')->name('user_change_information');


//print pdf file
Route::get('in-don-hang/{order_id}','App\Http\Controllers\PdfController@print_order')->name('print_order');

//payment online
Route::post('thanh-toan-momo','App\Http\Controllers\PaymentOnlineController@momo')->name('momo');
Route::get('xu-ly-thanh-toan-momo','App\Http\Controllers\PaymentOnlineController@handle_momo')->name('handle_momo');

//comment   
Route::post('danh-sach-binh-luan-tung-san-pham','App\Http\Controllers\CommentController@show_comment')->name('show_comment');
Route::post('binh-luan-san-pham','App\Http\Controllers\CommentController@send_comment')->name('send_comment');
Route::group(['prefix'=>'admin','middleware'=>['auth.AdminAndAuthor']],function()
{
    Route::get('danh-sach-binh-luan','App\Http\Controllers\CommentController@list_comment')->name('list_comment');
    Route::post('thay-doi-trang-thai-comment','App\Http\Controllers\CommentController@change_status_comment')->name('change_status_comment');
    Route::post('xoa-sub-comment','App\Http\Controllers\CommentController@delete_sub_comment')->name('delete_sub_comment');
    Route::post('xoa-comment','App\Http\Controllers\CommentController@delete_comment')->name('delete_comment');
});
Route::post('tra-loi-comment','App\Http\Controllers\CommentController@rep_comment')->name('rep_comment');


//login and login social
Route::get('dang-nhap-bang-google-mail','App\Http\Controllers\LoginController@login_google')->name('login_google');
Route::get('google/callback','App\Http\Controllers\LoginController@callback_google')->name('callback_google');
Route::get('dang-nhap','App\Http\Controllers\LoginController@login')->name('login');
Route::get('dang-xuat','App\Http\Controllers\LoginController@logout')->name('logout');
Route::post('dang-ki-tai-khoan','App\Http\Controllers\LoginController@register')->name('register_customer');
Route::post('xu-ly-dang-nhap','App\Http\Controllers\LoginController@handle_login')->name('handle_login_customer');

//category news 
Route::group(['prefix'=>'admin','middleware'=>['auth.AdminAndAuthor']],function()
{
    Route::get('them-danh-muc-tin-tuc','App\Http\Controllers\CategoryNewsController@add_category')->name('add_category_news');
    Route::post('xu-ly-them-danh-muc-tin-tuc','App\Http\Controllers\CategoryNewsController@handle_add_category')->name('handle_add_category_news');
    Route::get('danh-sach-danh-muc-tin-tuc','App\Http\Controllers\CategoryNewsController@list')->name('list_category_news');
    Route::get('sua-trang-thai-danh-muc-tin-tuc/{id}','App\Http\Controllers\CategoryNewsController@edit_status')->name('edit_status_category_news');
    Route::get('xoa-danh-muc-tin-tuc/{id}','App\Http\Controllers\CategoryNewsController@delete')->name('delete_category_news');
    Route::get('sua-danh-muc-tin-tuc/{id}','App\Http\Controllers\CategoryNewsController@edit_category_news')->name('edit_category_news');
    Route::post('xu-ly-sua-danh-muc-tin-tuc','App\Http\Controllers\CategoryNewsController@handle_edit_category_news')->name('handle_edit_category_news');
}); 

//news
Route::get('/them-tin-tuc','App\Http\Controllers\NewsController@insert')->name('add_news')->middleware('auth.AdminAndAuthor');
Route::group(['prefix'=>'admin','middleware'=>['auth.AdminAndAuthor']],function()
{
    //Route::get('/them-tin-tuc','App\Http\Controllers\NewsController@insert')->name('add_news');
    Route::post('xu-ly-them-tin-tuc','App\Http\Controllers\NewsController@handle_insert')->name('handle_insert_news');
    Route::get('danh-sach-tin-tuc','App\Http\Controllers\NewsController@list')->name('list_news');
    Route::get('xoa-danh-sach-tin-tuc/{id}','App\Http\Controllers\NewsController@delete')->name('delete_news');
    Route::get('sua-danh-sach-tin-tuc/{id}','App\Http\Controllers\NewsController@edit')->name('edit_news');
    Route::post('xu-ly-sua-danh-sach-tin-tuc','App\Http\Controllers\NewsController@handle_edit')->name('handle_edit_news');
    Route::get('sua-trang-thai-tin-tuc/{id}','App\Http\Controllers\NewsController@edit_status')->name('edit_status_news');
});
Route::get('danh-muc-tin-tuc/{slug}','App\Http\Controllers\NewsController@show_news_with_category')->name('show_news_with_category');
Route::get('noi-dung-tin-tuc/{slug}','App\Http\Controllers\NewsController@detail_news')->name('detail_news');


//setting information
Route::group(['prefix'=>'admin','middleware'=>['auth.AdminAndAuthor']],function()
{
    Route::get('sua-thong-tin-doanh-nghiep','App\Http\Controllers\SettingController@index')->name('change_setting_information');
    Route::post('xu-ly-sua-thong-tin-doanh-nghiep','App\Http\Controllers\SettingController@handle')->name('handle_edit_information_web');
});
//Notifications realtime
// gọi ra trang view demo-pusher.blade.php
//Route::get('demo-pusher','App\Http\Controllers\InboxController@getPusher');
// truyển message lên server Pusher
//Route::get('fire-event','App\Http\Controllers\InboxController@fireEvent');
Route::post('insert-notification','App\Http\Controllers\NotificationsController@insert_notification')->name('insert_notification');
// Route::post('insert-notification-admin','App\Http\Controllers\NotificationsAdminController@insert_notification')->name('insert_notification_admin');

Route::get('count-notification','App\Http\Controllers\NotificationsController@count_notifications')->name('count_notifications');
Route::get('count-notification-admin','App\Http\Controllers\NotificationsAdminController@count_notifications')->name('count_notifications_admin');

Route::get('handle-show-notifications','App\Http\Controllers\NotificationsController@show_notifications')->name('show_notifications');
Route::get('handle-show-notifications-admin','App\Http\Controllers\NotificationsAdminController@show_notifications')->name('show_notifications_admin');


//Statistic
Route::post('loc-doanh-thu-theo-thoi-gian','App\Http\Controllers\StatisticController@filter_turnover')->name('filter_turnover');
Route::get('doanh-thu-30-ngay','App\Http\Controllers\StatisticController@get_statistic_30days')->name('get_statistic_30days');
Route::post('doanh-thu-theo-khoang-thoi-gian','App\Http\Controllers\StatisticController@get_statistic_with_time')->name('get_statistic_with_time');


Route::get('/status', 'App\Http\Controllers\UserController@userOnlineStatus');