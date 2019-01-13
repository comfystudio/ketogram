<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Route::get('/', 'PagesController@holding');
//Route::get('/', 'PagesController@home');
//Route::get('/home', 'PagesController@home');
//Route::get('/holding', 'PagesController@holding');
//Route::post('/queries/create', 'QueriesController@create');
//Route::get('/blog', 'NewsController@index');
//Route::get('/blog/{slug}', 'NewsController@view');
//Route::get('/about', 'PagesController@about');
//Route::get('/faqs', 'PagesController@faqs');
//Route::get('/terms', 'PagesController@terms');
//Route::get('/privacy', 'PagesController@privacy');
//Route::get('/recipes', 'RecipesController@index');
//Route::get('/recipes/{slug}', 'RecipesController@view');
//Route::match(array('GET', 'POST'), '/settings/{user}', 'UsersController@settings');
//Route::post('/change-email/{user}', 'UsersController@email');
//Route::get('/shop', 'OrdersController@shop');
//Route::get('/items/{item}', 'ItemsController@view');
//Route::get('/items/update-cart/{item}/{quantity}/{type}', 'ItemsController@ajax_update_cart');
//Route::get('/items/remove-cart-items/{item}', 'ItemsController@ajax_remove_cart_items');
//Route::get('/cart', 'ItemsController@cart');
//Route::get('/checkout', 'OrdersController@checkout');
//
//Route::get('/coupons/check-coupon/{code}', 'CouponsController@check_coupon');
//Route::get('/coupons/check-coupon-custom/{code}', 'CouponsController@check_coupon_custom');
//Route::match(array('GET', 'POST'), '/share/{user}', 'CouponsController@share');
//
//Route::post('/payment', 'OrdersController@payment');
//Route::post('/payment-create', 'OrdersController@payment_create');
//Route::post('/payment-create-subscribe', 'SubscriptionsController@payment_create');
//Route::get('/orders/{user}', 'OrdersController@orders');
//Route::get('/orders/cancel/{order}', 'OrdersController@cancel');
//Route::post('/orders/cancel-post/{order}', 'OrdersController@cancel_post');
//Route::get('/subscriptions', 'SubscriptionsController@checkout');
////Route::get('/subscribe-custom', 'SubscriptionsController@custom');
//Route::get('/items/update-custom/{item}/{type}', 'ItemsController@ajax_update_custom');
//Route::get('/subscriptions/remove-custom-items/{item}', 'SubscriptionsController@ajax_remove_custom_items');
//Route::get('/subscribe-checkout/{custom?}', 'SubscriptionsController@checkout');
//Route::post('/subscribe-payment', 'SubscriptionsController@payment');
//Route::get('/subscriptions/{user}', 'SubscriptionsController@subscriptions');
//Route::get('/check-cancel', 'SubscriptionsController@check_cancel');
//Route::match(array('GET', 'POST'), '/subscriptions/update/{subscription}', 'SubscriptionsController@update_card');
////Route::match(array('GET', 'POST'), '/subscriptions/renew/{subscription}', 'SubscriptionsController@renew');
//Route::match(array('GET', 'POST'), '/subscriptions/cancel/{subscriptions}', 'SubscriptionsController@cancel');
//Route::match(array('GET', 'POST'), '/subscriptions/standard/{subscriptions}', 'SubscriptionsController@standard');
//Route::match(array('GET', 'POST'), '/subscriptions/address/{subscriptions}', 'SubscriptionsController@address');
//Route::match(array('GET', 'POST'), '/subscriptions/custom/{subscriptions}', 'SubscriptionsController@custom_switch');
//Route::match(array('GET', 'POST'), '/subscriptions/edit/{subscriptions}', 'SubscriptionsController@edit');
//Route::get('/newsletter', 'QueriesController@view');
//Route::match(array('GET', 'POST'), '/cancel-newsletter', 'UsersController@cancel_newsletter');
//
//// Admin authentication
Route::get('/admin/', 'AdminUsersController@admin_login')->name('login');
Route::get('/admin/login', 'AdminUsersController@admin_login')->name('login');
Route::post('/admin/login', 'AdminUsersController@admin_loginPost');
Route::get('/admin/logout', 'AdminUsersController@admin_logout');

//Admin section protected by middleware auth
Route::group(['middleware' => 'App\Http\Middleware\Admin'], function()
{
    // Admin-users block
    Route::get('/admin/admin-users', 'AdminUsersController@admin_index');
    Route::get('/admin/admin-users/create', 'AdminUsersController@admin_createShow');
    Route::post('/admin/admin-users/create', 'AdminUsersController@admin_create');
    Route::get('/admin/admin-users/generate-random-password', 'AdminUsersController@generatePassword');
    Route::get('/admin/admin-users/delete/{admin}', 'AdminUsersController@admin_deleteShow');
    Route::post('/admin/admin-users/delete/{admin}', 'AdminUsersController@admin_delete');
    Route::get('/admin/admin-users/edit/{admin}', 'AdminUsersController@admin_editShow');
    Route::post('/admin/admin-users/edit/{admin}', 'AdminUsersController@admin_edit');

    // Users block
    Route::get('/admin/users', 'UsersController@admin_index');
    Route::get('/admin/users/create', 'UsersController@admin_createShow');
    Route::post('/admin/users/create', 'UsersController@admin_create');
    Route::get('/admin/users/delete/{user}', 'UsersController@admin_deleteShow');
    Route::post('/admin/users/delete/{user}', 'UsersController@admin_delete');
    Route::get('/admin/users/edit/{user}', 'UsersController@admin_editShow');
    Route::post('/admin/users/edit/{user}', 'UsersController@admin_edit');

    // Categories
    Route::get('/admin/categories', 'CategoriesController@admin_index');
    Route::get('/admin/categories/create', 'CategoriesController@admin_createShow');
    Route::post('/admin/categories/create', 'CategoriesController@admin_create');
    Route::get('/admin/categories/delete/{categories}', 'CategoriesController@admin_deleteShow');
    Route::post('/admin/categories/delete/{categories}', 'CategoriesController@admin_delete');
    Route::get('/admin/categories/edit/{categories}', 'CategoriesController@admin_editShow');
    Route::post('/admin/categories/edit/{categories}', 'CategoriesController@admin_edit');

    // News
    Route::get('/admin/news', 'NewsController@admin_index');
    Route::get('/admin/news/create', 'NewsController@admin_createShow');
    Route::post('/admin/news/create', 'NewsController@admin_create');
    Route::get('/admin/news/delete/{news}', 'NewsController@admin_deleteShow');
    Route::post('/admin/news/delete/{news}', 'NewsController@admin_delete');
    Route::get('/admin/news/edit/{news}', 'NewsController@admin_editShow');
    Route::post('/admin/news/edit/{news}', 'NewsController@admin_edit');

    // News Images
    Route::get('/admin/news-images/{news}', 'NewsImagesController@admin_index');
    Route::get('/admin/news-images/{news}/create', 'NewsImagesController@admin_createShow');
    Route::post('/admin/news-images/{news}/create', 'NewsImagesController@admin_create');
    Route::get('/admin/news-images/{news}/delete/{images}', 'NewsImagesController@admin_deleteShow');
    Route::post('/admin/news-images/{news}/delete/{images}', 'NewsImagesController@admin_delete');
    Route::get('/admin/news-images/{news}/edit/{images}', 'NewsImagesController@admin_editShow');
    Route::post('/admin/news-images/{news}/edit/{images}', 'NewsImagesController@admin_edit');
    Route::get('/admin/news-images/{news}/download/{images}', 'NewsImagesController@admin_download');
    Route::get('/admin/news-images/{news}/sort/{direction}/{images}/{sort}', 'NewsImagesController@admin_sort');

    // Recipes
    Route::get('/admin/recipes', 'RecipesController@admin_index');
    Route::get('/admin/recipes/create', 'RecipesController@admin_createShow');
    Route::post('/admin/recipes/create', 'RecipesController@admin_create');
    Route::get('/admin/recipes/delete/{recipes}', 'RecipesController@admin_deleteShow');
    Route::post('/admin/recipes/delete/{recipes}', 'RecipesController@admin_delete');
    Route::get('/admin/recipes/edit/{recipes}', 'RecipesController@admin_editShow');
    Route::post('/admin/recipes/edit/{recipes}', 'RecipesController@admin_edit');

    // Recipes Images
    Route::get('/admin/recipes-images/{recipes}', 'RecipesImagesController@admin_index');
    Route::get('/admin/recipes-images/{recipes}/create', 'RecipesImagesController@admin_createShow');
    Route::post('/admin/recipes-images/{recipes}/create', 'RecipesImagesController@admin_create');
    Route::get('/admin/recipes-images/{recipes}/delete/{images}', 'RecipesImagesController@admin_deleteShow');
    Route::post('/admin/recipes-images/{recipes}/delete/{images}', 'RecipesImagesController@admin_delete');
    Route::get('/admin/recipes-images/{recipes}/edit/{images}', 'RecipesImagesController@admin_editShow');
    Route::post('/admin/recipes-images/{recipes}/edit/{images}', 'RecipesImagesController@admin_edit');
    Route::get('/admin/recipes-images/{recipes}/download/{images}', 'RecipesImagesController@admin_download');
    Route::get('/admin/recipes-images/{recipes}/sort/{direction}/{images}/{sort}', 'RecipesImagesController@admin_sort');

    // Queries
    Route::get('/admin/queries', 'QueriesController@admin_index');
    Route::get('/admin/queries/delete/{queries}', 'QueriesController@admin_deleteShow');
    Route::post('/admin/queries/delete/{queries}', 'QueriesController@admin_delete');
    Route::get('/admin/queries/download', 'QueriesController@admin_download');

    // Items
    Route::get('/admin/items', 'ItemsController@admin_index');
    Route::get('/admin/items/create', 'ItemsController@admin_createShow');
    Route::post('/admin/items/create', 'ItemsController@admin_create');
    Route::get('/admin/items/delete/{items}', 'ItemsController@admin_deleteShow');
    Route::post('/admin/items/delete/{items}', 'ItemsController@admin_delete');
    Route::get('/admin/items/edit/{items}', 'ItemsController@admin_editShow');
    Route::post('/admin/items/edit/{items}', 'ItemsController@admin_edit');
    Route::get('/admin/items/{items}/sort/{direction}/{sort}', 'ItemsController@admin_sort');

    // Items Sales
    Route::get('/admin/items-sales/create/{items}', 'ItemsSalesController@admin_createShow');
    Route::post('/admin/items-sales/create/{items}', 'ItemsSalesController@admin_create');

    // News Images
    Route::get('/admin/items-images/{items}', 'ItemsImagesController@admin_index');
    Route::get('/admin/items-images/{items}/create', 'ItemsImagesController@admin_createShow');
    Route::post('/admin/items-images/{items}/create', 'ItemsImagesController@admin_create');
    Route::get('/admin/items-images/{items}/delete/{images}', 'ItemsImagesController@admin_deleteShow');
    Route::post('/admin/items-images/{items}/delete/{images}', 'ItemsImagesController@admin_delete');
    Route::get('/admin/items-images/{items}/edit/{images}', 'ItemsImagesController@admin_editShow');
    Route::post('/admin/items-images/{items}/edit/{images}', 'ItemsImagesController@admin_edit');
    Route::get('/admin/items-images/{items}/download/{images}', 'ItemsImagesController@admin_download');
    Route::get('/admin/items-images/{items}/sort/{direction}/{images}/{sort}', 'ItemsImagesController@admin_sort');

    // Food Categories
    Route::get('/admin/food_categories', 'FoodCategoriesController@admin_index');
    Route::get('/admin/food_categories/create', 'FoodCategoriesController@admin_createShow');
    Route::post('/admin/food_categories/create', 'FoodCategoriesController@admin_create');
    Route::get('/admin/food_categories/delete/{categories}', 'FoodCategoriesController@admin_deleteShow');
    Route::post('/admin/food_categories/delete/{categories}', 'FoodCategoriesController@admin_delete');
    Route::get('/admin/food_categories/edit/{categories}', 'FoodCategoriesController@admin_editShow');
    Route::post('/admin/food_categories/edit/{categories}', 'FoodCategoriesController@admin_edit');

    // Orders
    Route::get('/admin/orders', 'OrdersController@admin_index');
//    Route::get('/admin/orders/create', 'OrdersController@admin_createShow');
//    Route::post('/admin/orders/create', 'OrdersController@admin_create');
    Route::get('/admin/orders/cancel/{orders}', 'OrdersController@admin_cancelShow');
    Route::post('/admin/orders/cancel/{orders}', 'OrdersController@admin_cancel');
    Route::match(array('GET', 'POST'), '/admin/orders/dispatch/{orders}', 'OrdersController@admin_dispatch');
//    Route::get('/admin/orders/edit/{orders}', 'OrdersController@admin_editShow');
//    Route::post('/admin/orders/edit/{orders}', 'OrdersController@admin_edit');

    // Coupons
    Route::get('/admin/coupons', 'CouponsController@admin_index');
    Route::get('/admin/coupons/create', 'CouponsController@admin_createShow');
    Route::post('/admin/coupons/create', 'CouponsController@admin_create');
    Route::get('/admin/coupons/delete/{coupons}', 'CouponsController@admin_deleteShow');
    Route::post('/admin/coupons/delete/{coupons}', 'CouponsController@admin_delete');
    Route::get('/admin/coupons/edit/{coupons}', 'CouponsController@admin_editShow');
    Route::post('/admin/coupons/edit/{coupons}', 'CouponsController@admin_edit');
    Route::get('/admin/coupons/generate-random-code', 'CouponsController@generateAjaxCode');

    // Subscriptions
    Route::get('/admin/subscriptions', 'SubscriptionsController@admin_index');
//    Route::get('/admin/orders/create', 'OrdersController@admin_createShow');
//    Route::post('/admin/orders/create', 'OrdersController@admin_create');
    Route::get('/admin/subscriptions/cancel/{subscriptions}', 'SubscriptionsController@admin_cancelShow');
    Route::post('/admin/subscriptions/cancel/{subscriptions}', 'SubscriptionsController@admin_cancel');
    Route::get('/admin/subscriptions/edit/{subscriptions}', 'SubscriptionsController@admin_editShow');
    Route::post('/admin/subscriptions/edit/{subscriptions}', 'SubscriptionsController@admin_edit');
    Route::post('/admin/subscriptions/ajax-get-items', 'SubscriptionsController@ajaxGetItems');
    Route::get('/admin/subscriptions/ajax-get-items', 'SubscriptionsController@ajaxGetItems');

    // Emails
    Route::get('/admin/emails', 'EmailsController@admin_index');
    Route::get('/admin/emails/create', 'EmailsController@admin_createShow');
    Route::post('/admin/emails/create', 'EmailsController@admin_create');
    Route::get('/admin/emails/delete/{emails}', 'EmailsController@admin_deleteShow');
    Route::post('/admin/emails/delete/{emails}', 'EmailsController@admin_delete');
    Route::get('/admin/emails/edit/{emails}', 'EmailsController@admin_editShow');
    Route::post('/admin/emails/edit/{emails}', 'EmailsController@admin_edit');
    Route::get('/admin/emails/test/{emails}', 'EmailsController@admin_test');
    Route::match(array('GET', 'POST'), '/admin/emails/send/{emails}', 'EmailsController@admin_send');

});

Auth::routes();
Route::get('/logout', 'Auth\LoginController@logout');



