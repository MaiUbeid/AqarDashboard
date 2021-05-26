<?php

namespace App;

use App\Models\City;
use App\Models\MemberType;
use App\Models\Neighborhood;
use App\Models\ServiceType;
use App\Unifonic\Client as UnifonicClient;
use App\Unifonic\UnifonicMessage;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'is_pay',
        'name',
        'email',
        'password',
        'type',
        'device_token',
        'device_type',
        'mobile',
        'api_token',
        'country_code',
        'confirmation_code',
        'logo',
        'services_id',
        'members_id',
        'lat',
        'lan',
        'address',
        'confirmation_password_code',
        'is_certified',
        'is_fund_certified',
        'user_name',
        'is_edit_username',
        'count_visit',
        'count_request',
        'count_offer',
        'count_agent',
        'saved_filter_city',
        'onwer_name',
        'office_staff',
        'experience',
        'rate',
    ];

    protected $appends = ['trial_period', 'link', 'member_name', 'service_name', 'member_name_web', 'service_name_web'];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function sendOtp($phone, $code)
    {

        $unifonicMessage = new UnifonicMessage();
        $unifonicClient = new UnifonicClient();
        $unifonicMessage->content = "Your Verification Code Is: ";
        $to = $phone;
        $co = $code;
        $data = $unifonicClient->sendVerificationCode($to, $co, $unifonicMessage);
        Log::channel('single')->info($data);
        return $data;
    }


    public function getLogoAttribute($value)
    {

        if ($value != null) {
            return url((@$this->attributes['logo']));
        }
    }


    public function getCityNameAttribute()
    {

        $city = City::where('serial_city', $this->city_id)->first();
        if ($city) {
            return $city->name;
        }

        return null;

    }


    public function getServiceNameAttribute()
    {


        if ($this->type == 'provider') {
            $array = explode(',', $this->services_id);
            $service = ServiceType::whereIn('id', $array)->get();
            $serviceName = '';
            foreach ($service as $serviceItem) {
                $serviceName .= ',' . $serviceItem->name;
            }

            return $service;
        } else {
            return null;
        }


        return null;

    }


    public function getMemberNameAttribute()
    {


        if ($this->type == 'provider') {
            $array = explode(',', $this->members_id);
            $service = MemberType::whereIn('id', $array)->get();
            $serviceName = '';
            foreach ($service as $serviceItem) {
                $serviceName .= ',' . $serviceItem->name;
            }

            return $service;
        } else {
            return null;
        }


        return null;

    }


    public function getServiceNameWebAttribute()
    {


        if ($this->type == 'provider') {
            $array = explode(',', $this->services_id);
            $service = ServiceType::whereIn('id', $array)->get();
            $serviceName = '';
            foreach ($service as $serviceItem) {
                $serviceName .= ',' . $serviceItem->name_ar;
            }

            return $serviceName;
        } else {
            return null;
        }


        return null;

    }


    public function getMemberNameWebAttribute()
    {


        if ($this->type == 'provider') {
            $array = explode(',', $this->members_id);
            $service = MemberType::whereIn('id', $array)->get();
            $serviceName = '';
            foreach ($service as $serviceItem) {
                $serviceName .= ',' . $serviceItem->name_ar;
            }

            return $serviceName;
        } else {
            return null;
        }


        return null;

    }

    public function getNeighborhoodNameAttribute()
    {

        $neighborhood = Neighborhood::where('neighborhood_serial', $this->neighborhood_id)
            ->first();
        if ($neighborhood) {
            return $neighborhood->name;
        }

        return null;

    }

    public function getLinkAttribute()
    {


        return url($this->user_name);

    }

    /*public function getRouteKeyName()
    {
        return 'username';
    }*/
    public static function isRequestedPathAPost()
    {
        return !preg_match('/[^\w\d\-\_]+/', \Request::path()) &&
            User::whereUserName(\Request::path())->exists();
    }

    public function getTrialPeriodAttribute()
    {


        $fdate = $this->created_at;
        $tdate = date('Y-m-d H:i:s');


        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $fdate);
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $tdate);

        $diff_in_days = $to->diffInDays($from);

        if ($diff_in_days > 10) {
            return 0;
        } else {
            return 1;
        }


    }


}
