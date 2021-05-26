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




Route::group([ 'prefix' => 'bank'], function () {


    Route::get('/get/v', function (Request $request) {
        echo '1';
    });

Route::get('login', 'Auth\LoginController@showLoginFormAdmin')->name('loginAdmin');
Route::post('login', 'Auth\LoginController@loginAdmin')->name('sendLoginAdmin');

Route::get('city/select2', 'AdminV2\SettingController@city_select2')->name('admin.city_select2');
Route::get('neighborhood/{id}/select2', 'AdminV2\SettingController@neighborhood_select2')->name('admin.neighborhood_select2');
Route::post('get/{id}/request', 'AdminV2\SettingController@getRequest')->name('admin.getRequest');
Route::post('get/{id}/user', 'AdminV2\SettingController@getUser')->name('admin.getUser');
Route::post('update/status', 'AdminV2\FundRequestController@updateStatus')->name('admin.updateStatus');
Route::post('update/deferred/status', 'AdminV2\DeferredInstallmentsController@updateStatus')->name('admin.updateDeferredStatus');
Route::post('get/{id}/offer', 'AdminV2\SettingController@getOffer')->name('admin.getOffer');


    Route::post('get/{id}/deferred/request', 'AdminV2\SettingController@getDeferredRequest')->name('admin.getdeferredRequest');
    Route::post('get/{id}/user', 'AdminV2\SettingController@getUser')->name('admin.getUser');
// adimn v2 (clean, faster, serverside)
// images
Route::group(['middleware' => ['role', 'language']], function () {

    Route::get('/dashboard', 'AdminV2\SettingController@index')->name('admin.dashboard.index');
    Route::get('/dashboard/lang/{lang}', 'AdminV2\SettingController@lang')->name('admin.dashboard.lang'); // new


    Route::get('/edit', 'AdminV2\SettingController@edit')->name('admin.settings.edit');
    Route::post('/edit', 'AdminV2\SettingController@update')->name('admin.settings.update');



    Route::post('/logout', 'Auth\LoginController@logout')->name('admin.logout'); // TODO

    // Categories
    Route::get('/bank/finance', 'AdminV2\FinanceController@index')->name('admin.bank_requests.index');
    Route::post('/bank/finance/datatable', 'AdminV2\FinanceController@datatable')->name('admin.bank_requests.datatable');

    Route::get('/bank/deferred/installments', 'AdminV2\DeferredInstallmentsController@index')->name('admin.deferred_installments.index');
    Route::post('/bank/deferred/installments/datatable', 'AdminV2\DeferredInstallmentsController@datatable')->name('admin.deferred_installments.datatable');


}); // end middleware Role IMAGE

});

