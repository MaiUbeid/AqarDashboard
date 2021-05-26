<?php

namespace App\Http\Controllers\AdminV2;

use App\Http\Resources\RequestFundOfferResource;
use App\Imports\CategoryColorImport;
use App\Imports\CityExport;
use App\Imports\CityMayImport;
use App\Imports\FundOfferExport;
use App\Imports\FundOfferOpartionExport;
use App\Imports\FundOfferSmsExport;
use App\Imports\FundRequestExport;
use App\Imports\FundValidUuidExport;
use App\Imports\NebExport;
use App\Imports\OfferWithProviderExport;
use App\Imports\ReginImport;
use App\Models\Admin;
use App\Models\FundRequestSmsStatus;
use App\Models\UserPayment;
use App\Models\ValidUuid;
use App\User;
use Excel;
use App\Models\City;
use App\Models\FundRequest;
use App\Models\FundRequestOffer;
use App\Models\Neighborhood;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{


    public function edit()
    {
        $html_breadcrumbs = [
            'title'    => __('views.My Profile'),
            'subtitle' => __('views.Index'),

        ];

        $admin = auth()->user();
        $update_url = route('admin.settings.update');
        $index_url = route('admin.dashboard.index');
        return view('admin_v2.setting.edit',
            compact('admin', 'index_url', 'update_url', 'html_breadcrumbs'));
    }

    public function update(Request $request)
    {

        $rules = [
            'name'   => 'required',
            'email'  => 'required',
            'mobile' => 'required',


        ];

        $this->validate($request, $rules);

        $admin = auth()->user();

        Admin::find($admin->id)
            ->update($request->only([
                'name',
                'mobile',
                'email'


            ]));


        if ($request->get('password')) {
            if (!\Hash::check($request->get('old_password'), $admin->password)) {
                return redirect()->route('admin.settings.edit')->with(['incorrect_pass' => trans('auth.password_incorrect')]);

            }
            $user = Admin::find($admin->id);
            $user->password = \Hash::make($request->get('password'));
            $user->save();
        }


        \Session::flash('success', trans('admin.success_update'));

        return redirect()->route('admin.settings.edit');
    } //<--- End Method


    public function index(Request $request)
    {


        $html_breadcrumbs = [
            'title'    => __('views.Dashboard'),
            'subtitle' => __('views.Index'),
        ];

        $offers = FundRequestOffer::whereHas('estate')->whereHas('fund_request');
        if ($request->get('request_fund')) {
            $offers = FundRequestOffer::whereHas('estate')->whereHas('fund_request')->where('uuid',
                $request->get('request_fund'));
        }

        if ($request->get('from_date') && $request->get('to_date')) {


            $offers = $offers->whereDate(
                'created_at',
                '>=',
                Carbon::parse($request->get('from_date'))
            );
            $offers = $offers->whereDate(
                'created_at',
                '<=',
                Carbon::parse($request->get('to_date'))
            );
        }

        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $offers = $offers->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $offers = $offers->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $offers = $offers->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $offers = $offers->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $offers = $offers->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }
        $offers = $offers->paginate(10);


        $requests = FundRequest::query();


        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $requests = $requests->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $requests = $requests->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $requests = $requests->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $requests = $requests->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $requests = $requests->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }


        $requests = $requests->count();
        $requests_content = FundRequest::query();


        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $requests_content = $requests_content->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $requests_content = $requests_content->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $requests_content = $requests_content->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $requests_content = $requests_content->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $requests_content = $requests_content->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }


        $requests_content = $requests_content->get();


        $requests_has_offer = FundRequest::whereHas('offers');


        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $requests_has_offer = $requests_has_offer->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $requests_has_offer = $requests_has_offer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $requests_has_offer = $requests_has_offer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $requests_has_offer = $requests_has_offer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $requests_has_offer = $requests_has_offer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }


        $requests_has_offer = $requests_has_offer->count();


        $accept_requests_from_fund = FundRequest::where('status', 'sending_code');


        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $accept_requests_from_fund = $accept_requests_from_fund->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $accept_requests_from_fund = $accept_requests_from_fund->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $accept_requests_from_fund = $accept_requests_from_fund->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $accept_requests_from_fund = $accept_requests_from_fund->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $accept_requests_from_fund = $accept_requests_from_fund->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }


        $accept_requests_from_fund = $accept_requests_from_fund->count();


        $accept_requests_from_customer = FundRequest::whereHas('offers')->where('status', 'accepted_customer');


        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $accept_requests_from_customer = $accept_requests_from_customer->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $accept_requests_from_customer = $accept_requests_from_customer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $accept_requests_from_customer = $accept_requests_from_customer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $accept_requests_from_customer = $accept_requests_from_customer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $accept_requests_from_customer = $accept_requests_from_customer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }


        $accept_requests_from_customer = $accept_requests_from_customer->count();


        $all_offer = FundRequestOffer::whereHas('estate')->whereHas('fund_request');


        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $all_offer = $all_offer->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $all_offer = $all_offer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $all_offer = $all_offer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $all_offer = $all_offer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $all_offer = $all_offer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }


        $all_offer = $all_offer->count();
        $active_offer = FundRequest::orderBy('count_offers', 'desc');


        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $active_offer = $active_offer->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $active_offer = $active_offer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $active_offer = $active_offer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $active_offer = $active_offer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $active_offer = $active_offer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }

        $active_offer = $active_offer->limit('5')
            ->get();


        $requests_dont_offer = FundRequest::doesntHave('offers');

        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $requests_dont_offer = $requests_dont_offer->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $requests_dont_offer = $requests_dont_offer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $requests_dont_offer = $requests_dont_offer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $requests_dont_offer = $requests_dont_offer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $requests_dont_offer = $requests_dont_offer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }


        $requests_dont_offer = $requests_dont_offer->limit('5')
            ->get();
        $custmer_accept_offer = FundRequestOffer::
        whereHas('estate')->whereHas('fund_request')->
        where('status', 'accepted_customer');


        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $custmer_accept_offer = $custmer_accept_offer->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $custmer_accept_offer = $custmer_accept_offer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $custmer_accept_offer = $custmer_accept_offer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $custmer_accept_offer = $custmer_accept_offer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $custmer_accept_offer = $custmer_accept_offer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }


        $custmer_accept_offer = $custmer_accept_offer->count();

        $providers = User::where('type', 'provider');


        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $providers = $providers->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $providers = $providers->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $providers = $providers->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $providers = $providers->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $providers = $providers->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }


        $providers = $providers->count();
        $providers_active = User::where('type', 'provider')
            ->where('is_pay', '1');


        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $providers_active = $providers_active->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $providers_active = $providers_active->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $providers_active = $providers_active->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $providers_active = $providers_active->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $providers_active = $providers_active->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }


        $providers_active = $providers_active->count();
        $user_payment = UserPayment::where('status', '0')
            ->pluck('user_id');

        $providers_not_payment = User::where('type', 'provider')
            ->whereIn('id', $user_payment->toArray());


        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $providers_not_payment = $providers_not_payment->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $providers_not_payment = $providers_not_payment->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $providers_not_payment = $providers_not_payment->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $providers_not_payment = $providers_not_payment->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $providers_not_payment = $providers_not_payment->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }


        $providers_not_payment = $providers_not_payment->count();

        $providers_best = User::where('type', 'provider')
            ->orderBy('count_offer', 'desc')
            ->orderBy('count_request', 'desc')
            ->count();


        $requests_sending_code_offer = FundRequest::whereHas('offers', function ($q) use ($request) {


            $q->where('status', 'sending_code');
        });


        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $requests_sending_code_offer = $requests_sending_code_offer->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $requests_sending_code_offer = $requests_sending_code_offer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $requests_sending_code_offer = $requests_sending_code_offer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $requests_sending_code_offer = $requests_sending_code_offer->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $requests_sending_code_offer = $requests_sending_code_offer->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }


        $requests_sending_code_offer = $requests_sending_code_offer->count();

        $requests_dont_offer_count = FundRequest::doesntHave('offers');


        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $requests_dont_offer_count = $requests_dont_offer_count->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $requests_dont_offer_count = $requests_dont_offer_count->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $requests_dont_offer_count = $requests_dont_offer_count->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $requests_dont_offer_count = $requests_dont_offer_count->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $requests_dont_offer_count = $requests_dont_offer_count->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }


            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }


        $requests_dont_offer_count = $requests_dont_offer_count->count();


        return view('admin_v2.dashboard.index'
            , compact(
                'requests',
                'requests_has_offer',
                'accept_requests_from_fund',
                'accept_requests_from_customer',
                'all_offer',
                'active_offer',
                'custmer_accept_offer',
                'html_breadcrumbs',
                'requests_dont_offer',
                'requests_content',
                'offers',
                'providers',
                'providers_active',
                'providers_not_payment',
                'requests_sending_code_offer',
                'requests_dont_offer_count'

            )

        );


    }


    public function lang(Request $request, $lang)
    {
        if (!in_array($lang, ['en', 'ar'])) {
            $lang = 'ar';
        }
        \Session::put('locale', $lang);
        return back();
    }


    public function city_select2(Request $request)
    {
        $search = $request->get('q', '');
        $data = City::where('name_ar', 'like', '%' . $search . '%')
            ->orWhere('name_en', 'like', '%' . $search . '%')
            ->paginate()->toArray();
        array_unshift($data['data'], [
            'id'    => 'null',
            'title' => __('root'),
        ]);
        return $data;
    }


    public function neighborhood_select2(Request $request)
    {
        $search = $request->get('q', '');
        $data = Neighborhood::where('city_id', $request->city_id)->
        where('name_ar', 'like', '%' . $search . '%')
            ->orWhere('name_en', 'like', '%' . $search . '%')
            ->where('neighborhood_serial', $request->city_id)
            ->paginate()->toArray();
        array_unshift($data['data'], [
            'id'    => 'null',
            'title' => __('root'),
        ]);
        return $data;
    }


    public function getRequest($id)
    {
        $request = FundRequest::where('uuid', $id)->first();

        if ($request) {
            return ['status' => true, 'data' => $request];
        } else {
            return ['status' => false, 'data' => []];
        }
    }

    public function getOffer($id)
    {
        $offer = FundRequestOffer::with('estate')->where('id', $id)->get();

        $collection = RequestFundOfferResource::collection($offer);

        if ($collection) {
            return ['status' => true, 'data' => $collection];
        } else {
            return ['status' => false, 'data' => []];
        }
    }


    public function export()
    {
        return view('admin_v2.export.export');
    }

    public function exportSms()
    {


        return Excel::download(new FundOfferSmsExport(), 'fundRequestsOfferSms_' . '_' . '.xlsx');

    }


    public function exportValidUuid()
    {


        return Excel::download(new FundOfferSmsExport(), 'fundRequestsOfferSms_' . '_' . '.xlsx');

    }

    public function ImportValidUuid(Request $request)
    {


        /*  $valid = ValidUuid::where('id', '>', 0)->pluck('uuid');
          $request = FundRequest::whereNotIn('uuid', $valid->toArray())->delete();*/


        $valid = FundRequest::where('id', '>', 0)->pluck('uuid');
        $requests = ValidUuid::whereNotIn('uuid', $valid->toArray())->pluck('uuid');


        dd($requests);
        Excel::import(new FundValidUuidExport(), public_path('uuid.xlsx'));

        return back();
    }


    public function CategoryColorImport(Request $request)
    {


        Excel::import(new CategoryColorImport(), public_path('categoriesColors.xlsx'));

        return back();
    }







    public function CityMayImport(Request $request)
    {


        Excel::import(new CityMayImport(), public_path('cit2.xlsx'));

        return back();
    }


    public function ReginImport(Request $request)
    {


        Excel::import(new ReginImport(), public_path('Reqion.xlsx'));

        return back();
    }



    public function export_fund(Request $request)
    {


        $rules = [
            'from_date' => 'required',
            'to_date'   => 'required',
            'type'      => 'required',


        ];

        $fromdate = $request->get('from_date');
        $todate = $request->get('to_date');

        $this->validate($request, $rules);

        if ($request->get('type') == 'request') {
            return Excel::download(new FundRequestExport($fromdate, $todate),
                'fundRequests_' . $request->get('from_date') . 'TO' . $request->get('to_date') . '.xlsx');

        } elseif ($request->get('type') == 'offers') {
            return Excel::download(new FundOfferExport($fromdate, $todate, 'all'),
                'fundRequestsOffer_' . $request->get('from_date') . 'TO' . $request->get('to_date') . '.xlsx');

        } elseif ($request->get('type') == 'offers_view') {
            return Excel::download(new FundOfferExport($fromdate, $todate, 'sending_code'),
                'fundRequestsOffer_' . $request->get('from_date') . 'TO' . $request->get('to_date') . '.xlsx');


        } elseif ($request->get('type') == 'offer_complete') {
            return Excel::download(new FundOfferExport($fromdate, $todate, 'accepted_customer'),
                'fundRequestsOffer_' . $request->get('from_date') . 'TO' . $request->get('to_date') . '.xlsx');

        }


        return back();
    }

    public function OfferWithProviderExport()
    {
        return Excel::download(new OfferWithProviderExport(),
            'CountProviderOffer_' . '.xlsx');
    }


    public function exportCity()
    {
        return Excel::download(new CityExport(),
            'exportCity' . '.xlsx');
    }
    public function exportNeighborhood()
    {
        return Excel::download(new NebExport(),
            'exportNeighborhood' . '.xlsx');
    }


    public function exportfundoperation()
    {
        return view('admin_v2.export.export_opeation');
    }

    public function export_fund_operation(Request $request)
    {


        $rules = [
            // 'from_date' => 'required',
            //  'to_date' => 'required',
            'type'      => 'required',
            'from_date' => 'required_if:type,0,1',
            'to_date'   => 'required_if:type,0,1',

        ];

        $fromdate = $request->get('from_date');
        $todate = $request->get('to_date');
        $type = $request->get('type');

        $this->validate($request, $rules);

        if ($request->get('type') != 'all') {
            return Excel::download(new FundOfferOpartionExport($fromdate, $todate, $type),
                'fundRequestsOperation_' . $request->get('from_date') . 'TO' . $request->get('to_date') . '.xlsx');

        } elseif ($request->get('type') == 'all') {
            return Excel::download(new FundOfferOpartionExport(null, null, 'all'),
                'fundRequestsOperation_all' . '.xlsx');

        }


        return back();
    }
}
