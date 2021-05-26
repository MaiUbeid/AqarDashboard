<?php

namespace App\Http\Controllers\AdminV2;

use App\Models\AreaEstate;

use App\Models\Bank;
use App\Models\EstatePrice;
use App\Models\EstateType;
use App\Models\FundRequest;
use App\Unifonic\Client as UnifonicClient;
use App\Models\Plan;
use App\Models\UserPayment;
use App\Models\UserPlan;
use App\Unifonic\UnifonicMessage;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;


class PaymentRequestController extends Controller
{
    public function index()
    {
        $index_url = route('admin.payment_requests.datatable');
        $edit_url = route('admin.payment_requests.edit', 'id');


        $object = new UserPayment();

        $html_breadcrumbs = [
            'title'     => __('views.payment_requests'),
            'subtitle'  => __('views.Index'),
            'datatable' => true,
        ];


        return view(
            'admin_v2.payment_requests.index',
            compact(
                'html_breadcrumbs',


                'index_url',
                'object',
                'edit_url'

            )
        );
    }

    public function datatable(Request $request)
    {


        //  dd($request->get('query')['neighborhood_id']);

        $finiceing = UserPayment::with('user');


        if ($request->get('offer_status')) {

            if ($request->get('offer_status') == 'have_offers') {
                $finiceing = $finiceing->whereHas('offers');
            } elseif ($request->get('offer_status') == 'have_offers') {
                $finiceing = $finiceing->doesntHave('offers');
            } elseif ($request->get('offer_status') == 'have_active_offers') {
                $finiceing = $finiceing->where('status', 'active');
            }


        }


        $data = process_datatable_query($finiceing->orderBy('id', 'desc'), function (
            $query,
            $search
        ) {
            return $query
                ->where(function ($query) use ($search) {


                    $query->whereHas('user', function ($q) use ($search) {
                        $q->where('mobile', 'like', '%' . $search . '%')
                            ->orWhere('name', 'like', '%' . $search . '%');
                    });


                });


        });
        return $data;
    }

    public function edit($id)
    {
        $payment_request = UserPayment::find($id);
        $plans = Plan::where('status', 1)->get();
        // dd($categories->toArray());
        $index_url = route('admin.payment_requests.index');
        $update_url = route('admin.payment_requests.update', $id);

        $html_breadcrumbs = [
            'title'    => __('views.payment_requests'),
            'subtitle' => __('views.Edit'),
        ];

        return view(
            'admin_v2.payment_requests.edit',
            compact('html_breadcrumbs', 'index_url', 'update_url', 'payment_request', 'plans')
        );
    }

    public function update(Request $request, $id)
    {


        // dd($request->all());
        $requestPayment = UserPayment::with('user')->find($id);


        $user = User::where('unique_code', $requestPayment->user->unique_code)->first();


        if (!isset($requestPayment)) {
            return redirect()->route('admin.payment_requests.index');
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
                $userDet = UserPlan::with('user','plan')->where('unique_code', $requestPayment->user->unique_code)->first();



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
                    'userDet'     => $userDet->user,
                    'planDet'     =>  $userDet->plan,
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


}
