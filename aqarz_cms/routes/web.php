<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/*
 |-----------------------------------
 | Index
 |--------- -------------------------
 */


/*
|
|----------------------------
| Webhook Paypal
|--------- ------------------
*/


/*
 |-----------------------------------
 | Social Login
 |--------- -------------------------
 */
// TODO delete one of those controller if notifications used


Route::group(['prefix' => 'admin'], function () {

    Route::get('/get/v', function (Request $request) {
        echo '1';
    });

    Route::get('login', 'Auth\LoginController@showLoginFormAdmin')->name('loginAdmin');
    Route::post('login', 'Auth\LoginController@loginAdmin')->name('sendLoginAdmin');

    Route::get('city/select2', 'AdminV2\SettingController@city_select2')->name('admin.city_select2');
    Route::get('neighborhood/{id}/select2',
        'AdminV2\SettingController@neighborhood_select2')->name('admin.neighborhood_select2');
    Route::post('get/{id}/user', 'AdminV2\SettingController@getUser')->name('admin.getUser');
    Route::post('get/{id}/offer', 'AdminV2\SettingController@getOffer')->name('admin.getOffer');

// adimn v2 (clean, faster, serverside)
// images
    Route::group(['middleware' => ['role', 'language']], function () {

        Route::get('/dashboard', 'AdminV2\SettingController@index')->name('admin.dashboard.index');
        Route::get('/dashboard/lang/{lang}', 'AdminV2\SettingController@lang')->name('admin.dashboard.lang'); // new


        Route::get('/edit', 'AdminV2\SettingController@edit')->name('admin.settings.edit');
        Route::post('/edit', 'AdminV2\SettingController@update')->name('admin.settings.update');


        Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout'); // TODO

        // Categories
        Route::get('/payment/requests', 'AdminV2\PaymentRequestController@index')->name('admin.payment_requests.index');
        Route::post('/requests/datatable',
            'AdminV2\PaymentRequestController@datatable')->name('admin.payment_requests.datatable');
        Route::get('payment/{id}/details',
            'AdminV2\PaymentRequestController@edit')->name('admin.payment_requests.edit');
        Route::put('payment/{id}', 'AdminV2\PaymentRequestController@update')->name('admin.payment_requests.update');


        Route::get('/providers', 'AdminV2\ProviderController@index')->name('admin.providers.index');
        Route::post('/providers', 'AdminV2\ProviderController@datatable')->name('admin.providers.datatable');
        Route::get('providers/{id}/details', 'AdminV2\ProviderController@edit')->name('admin.providers.edit');
        Route::get('providers/{id}/active', 'AdminV2\ProviderController@active')->name('admin.providers.active');
        Route::put('providers/{id}', 'AdminV2\ProviderController@update')->name('admin.providers.update');


        Route::post('/Certified/{id}/User', 'AdminV2\ProviderController@CertifiedUser')->name('admin.CertifiedUser');

        Route::get('/fund/offer/requests',
            'AdminV2\FundRequestOfferController@index')->name('admin.fund_requests_offer.index');
        Route::post('/requests/offer/datatable',
            'AdminV2\FundRequestOfferController@datatable')->name('admin.fund_requests_offer.datatable');


    }); // end middleware Role IMAGE
});


