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




Route::get('/tin-khuyen-mai/', 'Frontend\blogController@index')->name('tin');

Route::get('/tin-tong-hop/', 'Frontend\blogController@index')->name('tin-th');

Route::get('/', 'Frontend\indexController@index')->name('homeFe');
Route::get('/ckfinder.html', function () {
    return view('frontend.ckfinder');
    
})->middleware('auth');


Route::get('/landing-page', function () {
    return view('frontend.landingpage');
    
});


Route::get('/result.php', function () {
    return view('resultAlepay.result');
    
});


Route::post('alepay-pay','payController@payAlepay')->name('alepay');

Route::get('readfile', 'Frontend\indexController@readFile')->name('readfile');

Route::post('login-Fe', 'AjaxController@loginClientsFe')->name('login-Fe');

Route::get('logout-Fe', 'AjaxController@logout')->name('logout-Fe');


Route::get('sitemap.xml', 'sitemapController@index');

Route::get('sitemap_pc60.xml', 'sitemapController@sitemapChildProduct');

Route::get('sitemap_article.xml', 'sitemapController@sitemapChildBlog');

Route::get('inCrawl', 'crawlController@removelink')->name('print');

Route::get('/tin-chi-tiet', function () {
    return view('frontend.blogdetail');
    
});


// Route::any('/ckfinder/connector', '\CKSource\CKFinderBridge\Controller\CKFinderController@requestAction')
//     ->name('ckfinder_connector');

// Route::any('/ckfinder/browser', '\CKSource\CKFinderBridge\Controller\CKFinderController@browserAction')
//     ->name('ckfinder_browser');


Route::get('/add-property-filter', function () {
    return view('filter.add-property');
})->name('add-property-filter');

Route::post('filter-search-client', 'Frontend\filterController@filter')->name('client-search');

Route::get('/cache-clear', function () {
     \Artisan::call('key:generate');
      \Artisan::call('config:clear');
     echo "thanh cong";

})->middleware('auth');

Route::get('searchquery', 'productController@search')->name('test');


Route::get('tim', 'productController@FindbyNameOrModelOfFrontend')->name('search-product-frontend');

Auth::routes(['verify' => true]);

// Route::get('/home', 'HomeController@index');




Route::post('add-cart', 'AjaxController@addProductToCart')->name('cart');

Route::post('order-product', 'Frontend\orderController@orderProduct')->name('order');

Route::post('remove-cart', 'AjaxController@removeProductCart')->name('removeCart');

Route::post('show-cart', 'AjaxController@showProductCart')->name('showCart');

Route::post('add-cart-number', 'AjaxController@addProductToCartByNumber')->name('addCartNumber');

Route::post('rate-form', 'AjaxController@rateForm')->name('rate-form');



Route::get('/category/{slug}', 'Frontend\categoryController@index')->name('category-product')->middleware('auth');

Route::get('/{slug}', 'Frontend\categoryController@details')->name('details');

Route::post('ajax-clent-register', 'AjaxController@registerClient')->name('register-client-fe');

Route::post('muchsearch', 'AjaxController@muchSearch')->name('muchSearch');

Route::post('get-email-user', 'AjaxController@getEmail')->name('getemail');




Route::group(['prefix' => 'admins','middleware' => 'auth'], function() {

    Route::get('filter-group-id', 'dealController@getProductToGroupId')->name('filter-group-id');

    Route::get('fill-product-deal', 'dealController@getProductToName')->name('filter-product-deal');


    Route::post('/editFastPrice', 'productController@editFastPrice')->name('fast-price');

    Route::post('/edit-fast-Qualtity', 'productController@editFastQualtity')->name('edit-fast-qualtity');


    Route::get('deal', 'dealController@index')->name('deal');


    Route::get('home', 'HomeController@index')->name('home-admin');

    Route::get('delete-link-add', 'showController@deleteLinkAdd')->name('delete-link-add');


    

    Route::post('info-pop-up', 'showController@addPopup')->name('add-popup');

    Route::post('add-image-background', 'showController@addBackgroundSite')->name('add-image-background');

    Route::get('rate', function () {
        return view('rate.rate');
        
    })->name('rate-client');

    Route::get('/group-product/selected/{id}', 'groupProductController@showProductIdToUrl')->name('group-product-selected');

    Route::get('view-user', function () {

        if(Auth::user()->permision==1){
            return view('user.index');
        }
        else{
            echo"bạn không có quyền vào trang này";
        }
        
        
    })->name('view-user');

    Route::get('new-banner', function () {
        return view('newbanner.banner');
        
    })->middleware('auth');


    Route::get('order', 'Frontend\orderController@orderList')->name('order_list');

    Route::get('/order-list/{id}', 'Frontend\orderController@orderListView')->name('order_list_view');

    Route::post('/add-group-product-option', 'groupProductController@addGroupProduct')->name('add-group-product');

    Route::get('generator_builder', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@builder')->name('io_generator_builder');

    Route::get('field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@fieldTemplate')->name('io_field_template');

    Route::get('relation_field_template', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@relationFieldTemplate')->name('io_relation_field_template');

    Route::post('generator_builder/generate', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generate')->name('io_generator_builder_generate');

    Route::post('generator_builder/rollback', '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@rollback')->name('io_generator_builder_rollback');

    Route::get('show/pop-up', function () {
        return view('funcmore.popup');
        
    })->name('pop-up-show');

    Route::get('add-lanfding-pro', 'landingController@addLanding')->name('add-product-landing');

    Route::get('landingpage', function () {
        return view('landing.landing');
        
    })->name('landing');

    Route::get('add-hight-light', 'landingController@add_Hight_Light')->name('add-hight-light');

    Route::get('remove-hight-light', 'landingController@removeLanding')->name('remove-hight-light');

    Route::post(    
        'generator_builder/generate-from-file',
        '\InfyOm\GeneratorBuilder\Controllers\GeneratorBuilderController@generateFromFile'
    )->name('io_generator_builder_generate_from_file');

    Route::resource('metaSeos', 'metaSeoController');

    Route::resource('menus', 'menuController');

    Route::resource('posts', 'postController');

    Route::resource('banners', 'bannerController');

    Route::resource('categories', 'categoryController');

    Route::resource('groupProducts', 'groupProductController');

    Route::resource('makers', 'makerController');

    Route::resource('products', 'productController');

    Route::resource('images', 'imageController');

    Route::post('find-product', 'productController@FindbyNameOrModel')->name('find-product');

    Route::get('category/{category_id}', 'productController@selectProductByCategory')->name('select-category');

    Route::get('edit-property-child', 'propertyController@editPropertyChild')->name('property-edit-child');

    Route::get('remove-property-child', 'propertyController@removePropertyChild')->name('property-remove-child');

    Route::get('child-click', 'AjaxController@findChild')->name('filter-child-click');


    Route::get('add-active-post', 'postController@addActive')->name('add-active-post');

    Route::get('add-hight-light-post', 'postController@addHightLight')->name('add-hight-light-post');

    Route::resource('filters', 'filterController');


    Route::get('/filter', 'Frontend\filterController@index')->name('filter-property');

     Route::get('/filter-deal-products-add', 'dealController@GetProductbyId')->name('filter-deal-add');

     Route::get('/filter-deal-products-add-deal', 'dealController@add_Deal')->name('result-add');

     Route::get('/delete-deal', 'dealController@removeDeal')->name('delete-deal');


    Route::get('/active-deal', 'dealController@activeDeal')->name('active-deal');


    //ajax

    Route::post('add-selected-value-filter', 'AjaxController@addValueSelectFilter')->name('add-value-selected-filter');

    Route::get('filter-price-product', 'AjaxController@filterByValue')->name('filter-option');

    Route::post('add-promotion', 'AjaxController@add_promotion')->name('add-promotion');

    Route::post('add-group-gift', 'AjaxController@add_group_promotion')->name('add-group-gift');

    Route::post('add-gift', 'AjaxController@add_gift')->name('add-gift');

    Route::post('accept-rate', 'AjaxController@accept_rate')->name('accept-rate');


    Route::post('add-hot-product', 'AjaxController@addHotProduct')->name('add-hot-product');

    Route::post('remove-hot-product', 'AjaxController@removeHotProduct')->name('remove-hot-product');

    Route::post('add-sale-product', 'AjaxController@addSaleProduct')->name('add-sale-product');

    Route::post('remove-sale-product', 'AjaxController@removeSaleProduct')->name('remove-sale-product');

     Route::get('show-viewer-poduct', 'AjaxController@showViewerProduct')->name('show-viewed-product');

    Route::post('check-active', 'AjaxController@checkActive')->name('check-active');

    Route::post('add-active-confirm-product', 'AjaxController@addConfirm')->name('add-active-confirm');

    Route::resource('properties', 'propertyController');

    Route::resource('gifts', 'giftController');

});








