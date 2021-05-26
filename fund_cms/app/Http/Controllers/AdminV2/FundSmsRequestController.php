<?php

namespace App\Http\Controllers\AdminV2;

use App\Models\AreaEstate;

use App\Models\EstatePrice;
use App\Models\EstateType;
use App\Models\FundRequest;

use App\Models\FundRequestNeighborhood;
use App\Models\FundRequestSmsStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class  FundSmsRequestController extends Controller
{
    public function index()
    {
        $index_url = route('admin.fund_sms_status.datatable');


        $estate_type = EstateType::query()->get();
        $estate_area = AreaEstate::query()->get();
        $estate_price = EstatePrice::query()->get();
        $estate_dir = $array = ['شمال', 'جنوب', 'شرق', 'غرب'];
        $select2_city = route('admin.city_select2');
        $select2_neighborhood = route('admin.neighborhood_select2', 0);

        $object = new FundRequestSmsStatus();

        $html_breadcrumbs = [
            'title'     => __('views.fund_sms_status'),
            'subtitle'  => __('views.Index'),
            'datatable' => true,
        ];


        return view(
            'admin_v2.fund_sms_status.index',
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

        $finiceing = FundRequestSmsStatus::whereHas('fund_request_name')->with('fund_request_name');



        if(isset($request->get('query')['status']))
        {


                $finiceing = $finiceing->where('status',$request->get('query')['status']);

          /*  elseif($request->get('offer_status')=='have_offers')
            {
                $finiceing = $finiceing->doesntHave('offers');
            }*/



        }

        if(isset($request->get('query')['type']))
        {


            $finiceing = $finiceing->where('type',$request->get('query')['type']);

            /*  elseif($request->get('offer_status')=='have_offers')
              {
                  $finiceing = $finiceing->doesntHave('offers');
              }*/



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

        if ($request->get('uuid')) {
            $finiceing = $finiceing->where('uuid', $request->get('uuid'));
        }
        //  dd($finiceing);


        if (isset($request->get('query')['estate_type_id'])) {


            $finiceing = $finiceing->whereHas('fund_request_name', function ($q) use ($request) {


                $q->where('estate_type_id', $request->get('query')['estate_type_id']);
            });

        }

        if (isset($request->get('query')['city_id'])) {



            $finiceing = $finiceing->whereHas('fund_request_name', function ($q) use ($request) {


                $q->where('city_id', $request->get('query')['city_id']);
            });

        }

        if (isset($request->get('query')['neighborhood_id'])) {


            $nem=FundRequestNeighborhood::whereHas('fund_request')->whereIn('neighborhood_id',$request->get('query')['neighborhood_id'])
                ->pluck('request_fund_id');
            $finiceing = $finiceing->whereHas('fund_request_name', function ($q) use ($request,$nem) {


                $q->whereIn('id', $nem->toArray());
                //  ->where('total_area','<', $area_range->area_to);
            });


            //  whereIn('neighborhood_id', $request->get('query')['neighborhood_id']);
        }
        if (isset($request->get('query')['form_date'])) {
            $date = date_create($request->get('query')['form_date']);
            $date = date_format($date, "Y-m-d H:i:s");

            $finiceing = $finiceing->whereDate('created_at', '>', $date);




        }
        if (isset($request->get('query')['to_date'])) {
            $date = date_create($request->get('query')['to_date']);
            $date = date_format($date, "Y-m-d H:i:s");


            $finiceing = $finiceing->whereDate('created_at', '<', $date);


        }


        // $collection = RequestFundOfferResource::collection($finiceing);


        $data = process_datatable_query($finiceing->orderBy('id', 'desc'), function (
            $query,
            $search
        ) {
            return $query
                ->where(function ($query) use ($search) {
                    $query
                        ->where('uuid', 'like', '%' . $search . '%')
                        ->orWhere('error_msg', 'like', '%' . $search . '%')
                        ->orWhere('code', 'like', '%' . $search . '%');


                });
        });

        return $data;
    }




}
