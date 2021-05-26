<?php

namespace App\Http\Controllers\AdminV2;

use App\Http\Resources\RequestFundOfferResource;
use App\Models\AreaEstate;

use App\Models\EstatePrice;
use App\Models\EstateType;
use App\Models\FundRequest;

use App\Models\FundRequestOffer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class FundRequestOfferController extends Controller
{
    public function index()
    {
        $index_url = route('admin.fund_requests_offer.datatable');



        $estate_type = EstateType::query()->get();
        $estate_area = AreaEstate::query()->get();
        $estate_price = EstatePrice::query()->get();
        $estate_dir = $array = ['شمال', 'جنوب', 'شرق', 'غرب'];
        $select2_city = route('admin.city_select2');
        $select2_neighborhood = route('admin.neighborhood_select2', 0);

        $object = new FundRequestOffer();

        $html_breadcrumbs = [
            'title'     => __('views.fund_requests'),
            'subtitle'  => __('views.Index'),
            'datatable' => true,
        ];


        return view(
            'admin_v2.fund_request_offer.index',
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

        $finiceing = FundRequestOffer::with('fund_request','estate','estate.comforts','estate.EstateFile');



        if($request->get('uuid'))
        {
            $finiceing=$finiceing->where('uuid',$request->get('uuid'));
        }
      //  dd($finiceing);


        if (isset($request->get('query')['estate_type_id'])) {


            $finiceing = $finiceing->whereHas('estate', function ($q) use ($request) {


                $q->where('estate_type_id', $request->get('query')['estate_type_id']);
            });

        }
        if (isset($request->get('query')['area_estate_id'])) {


            $area_range=AreaEstate::findOrFail($request->get('query')['area_estate_id']);
            $finiceing = $finiceing->whereHas('estate', function ($q) use ($request,$area_range) {


                $q->where('total_area','>', $area_range->area_from)
                ->where('total_area','<', $area_range->area_to);
            });
        }
        if (isset($request->get('query')['dir_estate_id'])) {


            $array=['north','south','east','west'];
            $finiceing = $finiceing->whereHas('estate', function ($q) use ($request,$array) {


                $q->where('interface', $array[$request->get('query')['dir_estate_id']]);
                  //  ->where('total_area','<', $area_range->area_to);
            });

        }
        if (isset($request->get('query')['estate_price_id'])) {

            $price_range=EstatePrice::findOrFail($request->get('query')['estate_price_id']);




            $finiceing = $finiceing->whereHas('estate', function ($q) use ($request,$price_range) {


                $q->where('total_price','>', $price_range->estate_price_from)
                    ->where('total_price','<', $price_range->estate_price_to);
            });
        }
        if (isset($request->get('query')['city_id'])) {
            $finiceing = $finiceing->whereHas('estate', function ($q) use ($request) {


                $q->where('city_id', $request->get('query')['city_id']);
                //  ->where('total_area','<', $area_range->area_to);
            });
        }

        if (isset($request->get('query')['neighborhood_id'])) {

            $finiceing = $finiceing->whereHas('estate', function ($q) use ($request) {


                $q->where('neighborhood_id', $request->get('query')['neighborhood_id']);
                //  ->where('total_area','<', $area_range->area_to);
            });


            //  whereIn('neighborhood_id', $request->get('query')['neighborhood_id']);
        }
        if (isset($request->get('query')['form_date'])) {
            $date=date_create($request->get('query')['form_date']);
            $date= date_format($date,"Y-m-d H:i:s");

            $finiceing = $finiceing->whereHas('fund_request', function ($q) use ($request,$date) {


                $q->whereDate('created_at', '>',$date);
                //  ->where('total_area','<', $area_range->area_to);
            });

            $finiceing = $finiceing->whereDate('created_at', '>',$date);
        }
        if (isset($request->get('query')['to_date'])) {
            $date=date_create($request->get('query')['to_date']);
            $date= date_format($date,"Y-m-d H:i:s");

            $finiceing = $finiceing->whereHas('fund_request', function ($q) use ($request,$date) {


                $q->whereDate('created_at', '<',$date);
                //  ->where('total_area','<', $area_range->area_to);
            });


        }



       // $collection = RequestFundOfferResource::collection($finiceing);


        $data = process_datatable_query($finiceing->orderBy('id', 'decs'), function (
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
