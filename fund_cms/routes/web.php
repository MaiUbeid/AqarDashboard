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



Route::group([ 'prefix' => 'fund'], function () {

    Route::get('/get/v', function (Request $request) {
        echo '1';
    });


Route::get('login', 'Auth\LoginController@showLoginFormAdmin')->name('loginAdmin');
Route::post('login', 'Auth\LoginController@loginAdmin')->name('sendLoginAdmin');

Route::get('city/select2', 'AdminV2\SettingController@city_select2')->name('admin.city_select2');
Route::get('neighborhood/{id}/select2', 'AdminV2\SettingController@neighborhood_select2')->name('admin.neighborhood_select2');
Route::post('get/{id}/request', 'AdminV2\SettingController@getRequest')->name('admin.getRequest');
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
    Route::get('/requests', 'AdminV2\FundRequestController@index')->name('admin.fund_requests.index');
    Route::post('/requests/datatable', 'AdminV2\FundRequestController@datatable')->name('admin.fund_requests.datatable');





    Route::get('/requests/status', 'AdminV2\FundSmsRequestController@index')->name('admin.fund_sms_status.index');
    Route::post('/requests/status/datatable', 'AdminV2\FundSmsRequestController@datatable')->name('admin.fund_sms_status.datatable');




    Route::get('/offer/requests', 'AdminV2\FundRequestOfferController@index')->name('admin.fund_requests_offer.index');
    Route::post('/requests/offer/datatable', 'AdminV2\FundRequestOfferController@datatable')->name('admin.fund_requests_offer.datatable');



    Route::get('/CategoryColorImport', 'AdminV2\SettingController@CategoryColorImport')->name('admin.settings.CategoryColorImport');


    Route::get('/export', 'AdminV2\SettingController@export')->name('admin.settings.export');
    Route::get('/exportSms', 'AdminV2\SettingController@exportSms')->name('admin.settings.exportSms');
    Route::get('/exportCity', 'AdminV2\SettingController@exportCity')->name('admin.settings.exportCity');
    Route::get('/exportNeighborhood', 'AdminV2\SettingController@exportNeighborhood')->name('admin.settings.exportNeighborhood');








    Route::get('/ImportValidUuid', 'AdminV2\SettingController@ImportValidUuid')->name('admin.settings.ImportValidUuid');
    Route::get('/CityMayImport', 'AdminV2\SettingController@CityMayImport')->name('admin.settings.CityMayImport');
    Route::get('/ReginImport', 'AdminV2\SettingController@ReginImport')->name('admin.settings.ReginImport');



    Route::post('/export_fund', 'AdminV2\SettingController@export_fund')->name('admin.settings.export_fund');
    Route::get('/OfferWithProviderExport', 'AdminV2\SettingController@OfferWithProviderExport')->name('admin.settings.OfferWithProviderExport');
    Route::get('/FundRequestAcceptedExport', 'AdminV2\SettingController@FundRequestAcceptedExport')->name('admin.settings.FundRequestAcceptedExport');


    Route::get('/export/fund/operation', 'AdminV2\SettingController@exportfundoperation')->name('admin.settings.export.fund_operation');
    Route::post('/export_fund_operation', 'AdminV2\SettingController@export_fund_operation')->name('admin.settings.export_fund_operation');






    Route::get('/providers', 'AdminV2\ProviderController@index')->name('admin.providers.index');
    Route::post('/providers', 'AdminV2\ProviderController@datatable')->name('admin.providers.datatable');
}); // end middleware Role IMAGE
});


