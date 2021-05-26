<?php

namespace App\Http\Controllers\AdminV2;

use App\Http\Resources\RequestFundOfferResource;
use App\Models\Admin;

use App\Models\City;
use App\Models\DeferredInstallment;
use App\Models\Finance;
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

        $offers = Finance::query();


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


        $offers = $offers->paginate(10);
        $requests = Finance::query()->count();
        $requests_active = Finance::where('status', '1')->count();
        $requests_note_active = Finance::where('status', '0')->count();


        $DeferredInstallment = DeferredInstallment::query()->count();
        $DeferredInstallment_active = DeferredInstallment::where('status', '1')->count();
        $DeferredInstallment_note_active = DeferredInstallment::where('status', '0')->count();
        return view('admin_v2.dashboard.index'
            , compact(
                'requests',
                'requests_active',
                'requests_note_active',
                'DeferredInstallment_active',
                'DeferredInstallment_note_active',
                'DeferredInstallment',
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


    public function getRequest($id)
    {
        $request = Finance::where('id', $id)->first();

        if ($request) {
            return ['status' => true, 'data' => $request];
        } else {
            return ['status' => false, 'data' => []];
        }
    }

    public function getDeferredRequest($id)
    {
        $request = DeferredInstallment::where('id', $id)->first();

        if ($request) {
            return ['status' => true, 'data' => $request];
        } else {
            return ['status' => false, 'data' => []];
        }
    }


    public function getUser($id)
    {
        $request = User::where('id', $id)->first();

        if ($request) {
            return ['status' => true, 'data' => $request];
        } else {
            return ['status' => false, 'data' => []];
        }
    }


}
