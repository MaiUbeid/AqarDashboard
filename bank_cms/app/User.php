<?php

namespace App;

use App\Models\City;

use App\Models\Neighborhood;
use App\Models\ServiceType;
use App\Unifonic\Client as UnifonicClient;
use App\Unifonic\UnifonicMessage;
use http\Env\Request;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
    protected $table='users';
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
    ];

    protected $appends = ['link','service_name','service_name_web'];
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
                $serviceName .= ','.$serviceItem->name;
            }

            return $service;
        }

        else {
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
                $serviceName .= ','.$serviceItem->name_ar;
            }

            return $serviceName;
        }

        else {
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


        return url('provider/'.$this->id.'/show');

    }



}
