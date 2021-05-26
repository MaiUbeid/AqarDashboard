<?php

namespace App\Http\Controllers\AdminV2;

use App\Models\AreaEstate;

use App\Models\EstatePrice;
use App\Models\EstateType;
use App\Models\FundRequest;

use App\Models\FundRequestNeighborhood;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class FundRequestController extends Controller
{
    public function index()
    {
        $index_url = route('admin.fund_requests.datatable');


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
            'admin_v2.fund_request.index',
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

        $finiceing = FundRequest::with('neighborhood','offers');



        if($request->get('offer_status'))
        {

            if($request->get('offer_status')=='have_offers')
            {
                $finiceing = $finiceing->whereHas('offers');
            }
          /*  elseif($request->get('offer_status')=='have_offers')
            {
                $finiceing = $finiceing->doesntHave('offers');
            }*/
            if ($request->get('offer_status')=='have_active_offers')
            {
                $finiceing = $finiceing->where('status','sending_code');
            }

           if ($request->get('offer_status')=='dont_have_active_offers')
            {
                $finiceing = $finiceing->doesntHave('offers');
            }


            if ($request->get('offer_status')=='complete')
            {
                $finiceing = $finiceing
                    ->whereHas('offers')
                    ->where('status','accepted_customer');
            }

            if ($request->get('offer_status')=='rejected_customer')
            {
                $finiceing = $finiceing
                    ->whereHas('offers')
                    ->where('status','rejected_customer');
            }

        }

        if ($request->get('time')) {


            if ($request->get('time') == 'today') {
                $finiceing = $finiceing->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $finiceing = $finiceing->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $finiceing = $finiceing->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $finiceing = $finiceing->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $finiceing = $finiceing->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }



            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

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
        /*    $finiceing = $finiceing->whereHas('neighborhood', function ($q) use ($request) {


                $q->whereIn('neighborhood_id', $request->get('query')['neighborhood_id']);
            });
*/


            $nem=FundRequestNeighborhood::whereHas('fund_request')->whereIn('neighborhood_id',$request->get('query')['neighborhood_id'])
                ->pluck('request_fund_id');
            $finiceing = $finiceing->whereIn('id', $nem->toArray());




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
                    $query->where('uuid', 'like', '%' . $search . '%');


                });
        });

        return $data;
    }



}
