<?php

namespace App\Http\Controllers\AdminV2;

use App\Http\Resources\RequestFundOfferResource;
use App\Models\Admin;

use App\Models\City;
use App\Models\FundRequest;
use App\Models\FundRequestOffer;
use App\Models\Neighborhood;
use App\User;
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
                'email',
                'active_payment_link'


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

        $offers=FundRequestOffer::query();
        if($request->get('request_fund'))
        {
            $offers=FundRequestOffer::where('uuid',$request->get('request_fund'));
        }

        if ($request->get('from_date') && $request->get('to_date')) {


            $offers=      $offers->whereDate(
                'created_at',
                '>=',
                Carbon::parse($request->get('from_date'))
            );
            $offers=  $offers->whereDate(
                'created_at',
                '<=',
                Carbon::parse($request->get('to_date'))
            );
        }





        $offers=$offers->paginate(10);
        $requests = FundRequest::query()->count();
        $requests_content = FundRequest::query()->get();
        $requests_has_offer = FundRequest::whereHas('offers')->count();
        $accept_requests_from_fund = FundRequest::where('status', 'Waiting_provider_accepted')->count();
        $accept_requests_from_customer = FundRequest::where('status', 'customer_accepted')->count();
        $all_offer = FundRequestOffer::query()->count();
        $active_offer = FundRequest::orderBy('count_offers', 'desc')
            ->limit('5')
            ->get();

        $requests_dont_offer = FundRequest::doesntHave('offers')->limit('5')
            ->get();
        $custmer_accept_offer = FundRequestOffer::where('status', 'customer_accepted')->count();


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
                'offers'

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


    public function getUser($id)
    {
        $user = User::findOrFail($id);

        if ($user) {
            return ['status' => true, 'data' => $user];
        } else {
            return ['status' => false, 'data' => []];
        }
    }




}
