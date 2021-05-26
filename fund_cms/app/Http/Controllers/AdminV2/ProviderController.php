<?php

namespace App\Http\Controllers\AdminV2;

use App\Models\AreaEstate;

use App\Models\Bank;
use App\Models\Client;
use App\Models\Estate;
use App\Models\EstatePrice;
use App\Models\EstateRequest;
use App\Models\EstateType;
use App\Models\FundRequest;
use App\Models\FundRequestOffer;
use App\Models\RequestOffer;
use App\Unifonic\Client as UnifonicClient;
use App\Models\Plan;
use App\Models\UserPayment;
use App\Models\UserPlan;
use App\Unifonic\UnifonicMessage;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;

class ProviderController extends Controller
{
    public function index()
    {
        $index_url = route('admin.providers.datatable');



        $object = new User();

        $html_breadcrumbs = [
            'title'     => __('العقاريين'),
            'subtitle'  => __('views.Index'),
            'datatable' => true,
        ];


        return view(
            'admin_v2.providers.index',
            compact(
                'html_breadcrumbs',


                'index_url',
                'object'


            )
        );
    }

    public function datatable(Request $request)
    {






        //  dd($request->get('query')['neighborhood_id']);

        $user = User::where('type', 'provider');


        if ($request->get('user_status')) {

            if ($request->get('user_status') == 'have_active') {


                $user = $user->where('is_pay','1');
            }

            elseif ($request->get('user_status') == 'waite_active') {
                $user_payment=UserPayment::where('status','0')->pluck('user_id');

                $user = $user->whereIn('id',$user_payment->toArray());

            } elseif ($request->get('user_status') == 'best_providers') {
                $user = $user   ->orderBy('count_offer', 'desc')
                    ->orderBy('count_request', 'desc');


                $data = process_datatable_query($user->orderBy('id', 'desc'), function (
                    $query,
                    $search
                ) {
                    return $query
                        ->where(function ($query) use ($search) {


                            $query->where('mobile', 'like', '%' . $search . '%')
                                ->orWhere('name', 'like', '%' . $search . '%');


                        });


                });
                return $data;
            }


        }

        if ($request->get('time')) {
            if ($request->get('time') == 'today') {
                $user = $user->whereDate(
                    'created_at',
                    '=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'tow_today') {
                $user = $user->whereDate(
                    'created_at',
                    '>=',

                    Carbon::yesterday()->format('Y-m-d')
                );
                $user = $user->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }
            if ($request->get('time') == 'week') {
                $user = $user->whereDate(
                    'created_at',
                    '>=',

                    Carbon::now()->subDays(6)->format('Y-m-d')
                );
                $user = $user->whereDate(
                    'created_at',
                    '<=',
                    Carbon::parse(date('Y-m-d'))
                );
            }



            /* if ($request->get('time') == 'today') {
                 $offers = $offers->where('');
             }*/

        }
        $data = process_datatable_query($user->orderBy('id', 'desc'), function (
            $query,
            $search
        ) {
            return $query
                ->where(function ($query) use ($search) {



                        $query->where('mobile', 'like', '%' . $search . '%')
                            ->orWhere('name', 'like', '%' . $search . '%');



                });


        });
        return $data;
    }

    public function edit($id)
    {
        $user = User::find($id);
        $count_estate = Estate::where('user_id', $user->id)->count();
        $count_request = EstateRequest::where('user_id', $user->id)->count();
        $count_offer = RequestOffer::where('provider_id', $user->id)->count();
        $count_client = Client::where('user_id', $user->id)->count();
        $count_accept_offer = RequestOffer::where('provider_id', $user->id)
            ->where('status', 'accepted_customer')
            ->count();
        $count_accept_fund_offer = FundRequestOffer::where('provider_id', $user->id)
            ->where('status', 'accepted_customer')
            ->count();

        $new_estate = Estate::where('user_id', $user->id)->orderBy('id','desc')->limit(10)->get();
        $new_offer = RequestOffer::with('estate','user')->where('provider_id', $user->id)->orderBy('id','desc')->limit(10)->get();
        $new_fund_offer = FundRequestOffer::where('provider_id', $user->id)->orderBy('id','desc')->limit(10)->get();
        // dd($categories->toArray());



        $index_url = route('admin.providers.index');
        $update_url = route('admin.providers.update', $id);

        $html_breadcrumbs = [
            'title'    => __('views.providers'),
            'subtitle' => __('views.Edit'),
        ];

        return view(
            'admin_v2.providers.edit',
            compact('html_breadcrumbs', 'index_url', 'update_url', 'user',
                'count_estate',
                'count_request',
                'count_offer',
                'count_client',
                'count_accept_offer',
                'count_accept_fund_offer',
                'new_estate',
                'new_offer',
                'new_fund_offer'


            )
        );
    }

    public function update(Request $request, $id)
    {


        // dd($request->all());
        $requestPayment = User::find($id);


        $user = User::where('unique_code', $requestPayment->user->unique_code)->first();


        if (!isset($requestPayment)) {
            return redirect()->route('admin.providers.index');
        }


        $rules = [
            'payment_method_id' => 'required',
            //  'plan'               => 'required',

        ];

        $this->validate($request, $rules);
        $plan = \App\Models\Plan::find($id);


        if (!$user) {
            \Session::flash('success', trans('المستخدم لم يقدم طلب دفع'));

        }


        if ($request->get('payment_method_id') == 2) {
            if ($plan) {
                $paymentCheck = UserPlan::where('unique_code', $requestPayment->user->unique_code)->first();

                if (!$paymentCheck) {
                    $user_plan = UserPlan::create([
                        'plan_id'        => $plan->id,
                        'user_id'        => $user->id,
                        'status'         => '0',
                        'unique_code'    => $requestPayment->user->unique_code,
                        'payment_method' => $request->get('payment_method_id'),
                        'payment_url'    => null,
                        'count_try'      => 0,
                        'total'          => $plan->price
                    ]);
                }


                $text = 'شكرا لإشتراكك معنا ونرحب بإنضمامك لعائلة عقارز';
                $message = 'http://aqarz.sa/plans/' . $user->unique_code;
                ini_set("smtp_port", "465");
                $banks = Bank::where('status', '1')->get();
                $userDet = UserPlan::with('user', 'plan')->where('unique_code',
                    $requestPayment->user->unique_code)->first();


                $to = $user->email;


                $from = 'info@aqarz.sa';
                $name = 'Aqarz';
                $subject = 'شكرا لإشتراكك معنا';


                $logo = asset('logo.svg');
                $link = '#';

                $details = [
                    'to'       => $to,
                    'from'     => $from,
                    'logo'     => $logo,
                    'link'     => $link,
                    'subject'  => $subject,
                    'name'     => $name,
                    "message"  => $message,
                    "text_msg" => $text,
                    'banks'    => $banks,
                    'userDet'  => $userDet->user,
                    'planDet'  => $userDet->plan,
                ];


                // var_export (dns_get_record ( "host.name.tld") );

                // dd(444);
                \Mail::to($to)->send(new \App\Mail\NewBankMail($details));

                /* if (Mail::failures()) {
                     return response()->json([
                         'status'  => false,
                         'data'    => $details,
                         'message' => 'Nnot sending mail.. retry again...'
                     ]);
                 }*/


                $user_mobile = checkIfMobileStartCode($user->mobile, $user->country_code);
                $unifonicMessage = new UnifonicMessage();
                $unifonicClient = new UnifonicClient();
                $unifonicMessage->content = "تم ارسال معلومات الدفع الخاصة بك الي البريدالالكتروني ";
                $to = $user_mobile;
                $co = $message;
                $data = $unifonicClient->sendCustomer($to, $co);
                \Log::channel('single')->info($data);
                \Log::channel('slack')->info($data);

            }


        } else {

            $text = 'رابط الدفع الخاص بك هو : ';
            $message = 'http://aqarz.sa/plans/' . $user->unique_code;
            ini_set("smtp_port", "465");

            $to = $user->email;


            $from = 'info@aqarz.sa';
            $name = 'Aqarz';
            $subject = 'رابط الدفع';


            $logo = asset('logo.svg');
            $link = '#';

            $details = [
                'to'       => $to,
                'from'     => $from,
                'logo'     => $logo,
                'link'     => $link,
                'subject'  => $subject,
                'name'     => $name,
                "message"  => $message,
                "text_msg" => $text,
            ];


            // var_export (dns_get_record ( "host.name.tld") );

            // dd(444);
            \Mail::to($to)->send(new \App\Mail\NewMail($details));

            /* if (Mail::failures()) {
                 return response()->json([
                     'status'  => false,
                     'data'    => $details,
                     'message' => 'Nnot sending mail.. retry again...'
                 ]);
             }*/


            $user_mobile = checkIfMobileStartCode($user->mobile, $user->country_code);
            $unifonicMessage = new UnifonicMessage();
            $unifonicClient = new UnifonicClient();
            $unifonicMessage->content = "Your Verification Code Is: ";
            $to = $user_mobile;
            $co = $message;
            $data = $unifonicClient->sendCustomer($to, $co);
            \Log::channel('single')->info($data);
            \Log::channel('slack')->info($data);


            //  return $data;
        }


        \Session::flash('success', trans('تم ارسال بيانات الدفع بنجاح'));

        return redirect()->route('admin.payment_requests.index');
    }

    public function CertifiedUser($id)
    {
        $user = User::findOrFail($id);
        if ($user) {
            $user->is_certified = $user->is_certified == '1' ? '0' : '1';
            $user->save();
            return ['status' => true, 'check' => $user->is_certified];
        } else {
            return ['status' => false, 'check' => 0];
        }

    }
}
