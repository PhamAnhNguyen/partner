<?php

use Illuminate\Session\TokenMismatchException;

/**
 * FRONT
 */
Route::get('partner', [
    'as' => 'partner',
    'uses' => 'Foostart\Partner\Controllers\Front\PartnerFrontController@index'
]);

Route::get('partner/delete', [
    'as' => 'partner.delete',
    'uses' => 'Foostart\Partner\Controllers\Front\PartnerFrontController@delete'
]);
Route::get('partner/edit', [
    'as' => 'partner.edit',
    'uses' => 'Foostart\Partner\Controllers\Front\PartnerFrontController@edit'
]);
Route::post('partner/edit', [
    'as' => 'partner.post',
    'uses' => 'Foostart\Partner\Controllers\Front\PartnerFrontController@post'
]);
Route::post('partner', [
    'as' => 'partner',
    'uses' => 'Foostart\Partner\Controllers\Front\PartnerFrontController@add'
]);




/**
 * ADMINISTRATOR
 */
Route::group(['middleware' => ['web']], function () {

    Route::group(['middleware' => ['admin_logged', 'can_see']], function () {

        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////SAMPLES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        /**
         * list
         */
        Route::get('admin/partner', [
            'as' => 'admin_partner',
            'uses' => 'Foostart\Partner\Controllers\Admin\PartnerAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/partner/edit', [
            'as' => 'admin_partner.edit',
            'uses' => 'Foostart\Partner\Controllers\Admin\PartnerAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/partner/edit', [
            'as' => 'admin_partner.post',
            'uses' => 'Foostart\Partner\Controllers\Admin\PartnerAdminController@post'
        ]);

        /**
         * delete
         */
        Route::get('admin/partner/delete', [
            'as' => 'admin_partner.delete',
            'uses' => 'Foostart\Partner\Controllers\Admin\PartnerAdminController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////SAMPLES ROUTE///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
        Route::get('admin/partner_category', [
            'as' => 'admin_partner_category',
            'uses' => 'Foostart\Partner\Controllers\Admin\PartnerCategoryAdminController@index'
        ]);

        /**
         * edit-add
         */
        Route::get('admin/partner_category/edit', [
            'as' => 'admin_partner_category.edit',
            'uses' => 'Foostart\Partner\Controllers\Admin\PartnerCategoryAdminController@edit'
        ]);

        /**
         * post
         */
        Route::post('admin/partner_category/edit', [
            'as' => 'admin_partner_category.post',
            'uses' => 'Foostart\Partner\Controllers\Admin\PartnerCategoryAdminController@post'
        ]);
        /**
         * delete
         */
        Route::get('admin/partner_category/delete', [
            'as' => 'admin_partner_category.delete',
            'uses' => 'Foostart\Partner\Controllers\Admin\PartnerCategoryAdminController@delete'
        ]);
        ////////////////////////////////////////////////////////////////////////
        ////////////////////////////CATEGORIES///////////////////////////////
        ////////////////////////////////////////////////////////////////////////
    });
});
