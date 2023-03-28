<?php

use Illuminate\Support\Facades\Route;

// ==========ADMIN LOGIN==========
Route::post( 'login-admin', 'Auth\AdminLoginController@login' );
Route::get( 'login-check', 'Auth\AdminLoginController@loginCheck' )->name( 'admin.loginCheck' );

Route::group( ['middleware' => 'auth:admin'], function () {
    Route::get( 'logout', 'Auth\AdminLoginController@logout' )->name( 'admin.logout' );
    /* -----TABLE SORTING FOR GLOBALLY------*/
    Route::get( 'table-sorting', 'Base\SortingController@sorting' );
    Route::get( 'get-last-sorting', 'Base\SortingController@lastSorting' );
} );

Route::group( ['namespace' => 'Backend', 'middleware' => 'auth:admin'], function () {
    Route::view( 'ckfinder-custom', 'ckfinder' );
    /*-----SYSTEM PORTION-----*/
    Route::get( 'systems-update', 'System\RoleController@systemsRoleUpdate' );
    Route::get( 'get-menus/{any?}', 'System\MenuController@menus' );
    Route::get( 'initialize-systems', 'System\LibController@systems' );
    Route::get( 'get-permissions', 'System\RoleController@getPermissions' );
    /*-----ADMIN PORTION-----*/
    Route::post( 'check-old-password', 'AdminController@checkOldPassword' );
    Route::post( 'change-password', 'AdminController@passwordChange' );
    Route::get( 'get-dashboard-menus', 'System\MenuController@dashboardMenu' );
    Route::get( 'get-statistics', 'System\LibController@getStatistics' );
    /*-----MODULE PORTION-----*/
    Route::view( 'module', 'layouts.backend_app' )->name( 'module.index' );
    Route::get( 'module/check-model', 'System\ModuleController@checkModel' );
    /*-----DASHBOARD PATH-----*/
    Route::view( 'dashboard', 'layouts.backend_app' )->name( 'admin.dashboard' );
    Route::view( 'sitemap', 'layouts.backend_app' );
    /* -----Frontend Parent Menu && Content------*/
    Route::get( 'parent-menus', 'Website\FrontMenuController@getParentMenu' );
    Route::get( 'get-content', 'PageController@getPagesForMenu' );
    Route::get( 'get-album/{type}', 'Website\Gallery\AlbumController@album' );

    Route::get('categories','System\LibController@category');
    Route::get('portfolio-types','System\LibController@portfolio_types');

    /*-----PERMITTED USER CAN ACCESS THIS PAGE-----*/
    Route::group( ['middleware' => ['auth.access']], function () {
        /*-----MODULE PORTION-----*/
        Route::match( ['get', 'post'], 'module/create', 'System\ModuleController@create' )
            ->name( 'module.create' );
        /*-----BACK-END-----*/
        Route::resource( 'role', 'System\RoleController' );
        Route::resource( 'menu', 'System\MenuController' );
        Route::resource( 'admin', 'AdminController' );
        Route::resource( 'siteSetting', 'System\SiteSettingController' );
        /*-----ACTIVITY LOG-----*/
        Route::get( 'activityLog', 'System\ActivityLogController@index' )->name( 'activityLog.index' );
        Route::get( 'activityLog/{id}', 'System\ActivityLogController@show' )->name( 'activityLog.show' );
        Route::get( 'allRead', 'System\ActivityLogController@allRead' )->name( 'activityLog.allRead' );
        Route::delete( 'activityLog/{id}', 'System\ActivityLogController@destroy' )->name( 'activityLog.destroy' );

        /*-----FRONT-END-----*/
        Route::resource( 'frontMenu',   'Website\FrontMenuController' );
        Route::resource( 'album',       'Website\Gallery\AlbumController' );
        Route::resource( 'photo',       'Website\Gallery\PhotoController' );
        Route::resource( 'video',       'Website\Gallery\VideoController' );
        Route::resource( 'slider',      'Website\Gallery\SliderController' );
        Route::resource( 'news',        'Website\NewsController' );
        /*-----CONTENT PORTION-----*/

        Route::get( 'content/{content}', 'Website\ContentController@show' )->name( 'content.show' );
        Route::get( 'content/{slug}/create', 'Website\ContentController@create' )->name( 'content.create' );
        Route::get( 'content-file/{slug}', 'Website\ContentController@create' )->name( 'content.file' );
        Route::post( 'content', 'Website\ContentController@store' )->name( 'content.store' );
        Route::post( 'content-file/{content}', 'Website\ContentController@storeFile' )->name( 'content.storeFile' );
        Route::delete( 'content/{contentFile}', 'Website\ContentController@destroy' )->name( 'content.destroy' );

        /*-----USER PORTION-----*/
        Route::resource( 'user', 'UserController' );
        /*-----PAYMENTS PORTION-----*/
        Route::resource( 'accountHead', 'MasterSetup\AccountHeadController');
        Route::resource( 'invoice', 'InvoiceController' );
        Route::resource( 'page', 'PageController');

        Route::resource('inquiry', 'InquiryController');
        Route::resource('about', 'AboutController');
        Route::resource('category', 'CategoryController');
        Route::resource('typePortfolio',   'TypePortfolioController');
        Route::resource('portfolio', 'PortfolioController');
        Route::resource('photographyPrice',   'PhotographyPriceController');
        Route::resource('service',   'ServiceController');
        Route::resource('serviceDetails',   'ServiceDetailsController');
        // PARENT MENU FOR PERMISSION (only for 2nd level parent menu)
        Route::get( 'cparent', 'PMenuController@content' )->name( 'content.content' );
        Route::get( 'gparent', 'PMenuController@galleryImages' )->name( 'gallery.galleryImages' );
    } );

} );
