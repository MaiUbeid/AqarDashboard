<?php

namespace App\Http\Controllers\AdminV2;

use App\Models\AreaEstate;

use App\Models\EstatePrice;
use App\Models\EstateType;
use App\Models\Finance;
use App\Models\FundRequest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class FinanceController extends Controller
{
    public function index()
    {
        $index_url = route('admin.bank_requests.datatable');


        $estate_type = EstateType::query()->get();
        $estate_area = AreaEstate::query()->get();
        $estate_price = EstatePrice::query()->get();
        $estate_dir = $array = ['شمال', 'جنوب', 'شرق', 'غرب'];
        $select2_city = route('admin.city_select2');
        $select2_neighborhood = route('admin.neighborhood_select2', 0);

        $object = new FundRequest();

        $html_breadcrumbs = [
            'title'     => __('views.fund_requests'),
            'subtitle'  => __('views.Index'),
            'datatable' => true,
        ];


        return view(
            'admin_v2.finances.index',
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

        $finiceing = Finance::with('user');



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
            $finiceing = $finiceing->whereHas('neighborhood', function ($q) use ($request) {


                $q->whereIn('neighborhood_id', $request->get('query')['neighborhood_id']);
            });


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
                    $query->where('name', 'like', '%' . $search . '%');


                });
        });

        return $data;
    }

    public function updateStatus(Request $request)
    {



        $request_order = Finance::where('id', $request->get('id'))->first();



        if ($request) {
            $request_order->status = ''.$request->get('status_id').'';
            $request_order->save();


            \Session::flash('success', trans('admin.success_update'));

            return redirect()->route('admin.bank_requests.index');
        } else {

            \Session::flash('error', trans('هناك خطأ'));

            return redirect()->route('admin.bank_requests.index');
        }
    }

}
