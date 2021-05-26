<?php

namespace App\Http\Controllers\AdminV2;

use App\Models\AreaEstate;

use App\Models\DeferredInstallment;
use App\Models\EstatePrice;
use App\Models\EstateType;
use App\Models\Finance;
use App\Models\FundRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class DeferredInstallmentsController extends Controller
{
    public function index()
    {
        $index_url = route('admin.deferred_installments.datatable');


        $estate_type = EstateType::query()->get();
        $estate_area = AreaEstate::query()->get();
        $estate_price = EstatePrice::query()->get();
        $estate_dir = $array = ['شمال', 'جنوب', 'شرق', 'غرب'];
        $select2_city = route('admin.city_select2');
        $select2_neighborhood = route('admin.neighborhood_select2', 0);

        $object = new DeferredInstallment();

        $html_breadcrumbs = [
            'title'     => __('views.deferred_installments'),
            'subtitle'  => __('views.Index'),
            'datatable' => true,
        ];


        return view(
            'admin_v2.deferred_installments.index',
            compact(
                'html_breadcrumbs',
                'select2_city',
                'select2_neighborhood',
                'index_url',
                'object',
                'estate_type',
                'estate_area',
                'estate_price',
                'estate_dir'
            )
        );
    }

    public function datatable(Request $request)
    {


        //  dd($request->get('query')['neighborhood_id']);

        $finiceing = DeferredInstallment::with('user');



        if($request->get('status'))
        {

            if($request->get('status')=='active')
            {
                $finiceing = $finiceing->where('status','1');
            }
            if($request->get('status')=='not_active')
            {
                $finiceing = $finiceing->where('status','0');
            }
            if($request->get('status')=='waiting')
            {
                $finiceing = $finiceing->where('status','3');
            }


        }

      //  dd($finiceing);


        if (isset($request->get('query')['estate_type_id'])) {
            $finiceing = $finiceing->where('estate_type_id', $request->get('query')['estate_type_id']);
        }
        if (isset($request->get('query')['area_estate_id'])) {
            $finiceing = $finiceing->where('area_estate_id', $request->get('query')['area_estate_id']);
        }
        if (isset($request->get('query')['dir_estate_id'])) {
            $finiceing = $finiceing->where('dir_estate_id', $request->get('query')['dir_estate_id']);
        }
        if (isset($request->get('query')['estate_price_id'])) {
            $finiceing = $finiceing->where('estate_price_id', $request->get('query')['estate_price_id']);
        }
        if (isset($request->get('query')['city_id'])) {
            $finiceing = $finiceing->where('city_id', $request->get('query')['city_id']);
        }

        if (isset($request->get('query')['neighborhood_id'])) {

            //dd( $request->get('query')['neighborhood_id']);
            // dd($request->get('query')['neighborhood_id']);



            $finiceing = $finiceing->where('neighborhood_id', $request->get('query')['neighborhood_id']);



            //  whereIn('neighborhood_id', $request->get('query')['neighborhood_id']);
        }
        if (isset($request->get('query')['form_date'])) {
            $date=date_create($request->get('query')['form_date']);
            $date= date_format($date,"Y-m-d H:i:s");

            $finiceing = $finiceing->whereDate('created_at', '>',$date);
        }
        if (isset($request->get('query')['to_date'])) {

            $date=date_create($request->get('query')['to_date']);
            $date= date_format($date,"Y-m-d H:i:s");
            $finiceing = $finiceing->whereDate('created_at', '<', $date);
        }


        $data = process_datatable_query($finiceing->orderBy('id', 'desc'), function (
            $query,
            $search
        ) {
            return $query
                ->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                    ->where('name', 'like', '%' . $search . '%')
                    ->orWhere('rent_price', 'like', '%' . $search . '%')
                    ->orWhere('owner_name', 'like', '%' . $search . '%')
                    ->orWhere('owner_mobile', 'like', '%' . $search . '%')
                    ->orWhere('owner_identity_number', 'like', '%' . $search . '%')
                    ->orWhere('tenant_name', 'like', '%' . $search . '%')
                    ->orWhere('tenant_mobile', 'like', '%' . $search . '%')
                    ->orWhere('tenant_identity_number', 'like', '%' . $search . '%')
                    ->orWhere('tenant_job_type', 'like', '%' . $search . '%')
                    ->orWhere('employer_name', 'like', '%' . $search . '%');


                });
        });

        return $data;
    }

    public function updateStatus(Request $request)
    {



        $request_order = DeferredInstallment::where('id', $request->get('id'))->first();



        if ($request) {
            $request_order->status = ''.$request->get('status_id').'';
            $request_order->save();


            \Session::flash('success', trans('admin.success_update'));

            return redirect()->route('admin.deferred_installments.index');
        } else {

            \Session::flash('error', trans('هناك خطأ'));

            return redirect()->route('admin.bank_requests.index');
        }
    }

}
