<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Finance extends Model
{
    /**
     * The attributes that are guarded from  mass assignable.
     *
     * @var array
     */
    // protected $connection = 'customer';

    protected $guarded = [

    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'operation_type_id',
        'estate_type_id',
        'job_type',
        'finance_interval',
        'job_start_date',
        'estate_price',
        'engagements',
        'city_id',
        'name',
        'identity_number',
        'identity_file',
        'mobile',

        'total_salary',


        'available_amount',
        'national_address',
        'national_address_file',
        'building_number',
        'street_name',
        'neighborhood_name',
        'building_city_name',
        'postal_code',
        'status',
        'additional_number',
        'unit_number',
        'solidarity_partner',
        'solidarity_salary',
        'user_id',
        'offer_numbers',
        'bank_id',
        'birthday',
        'is_subsidized_property',
        'is_first_home',

    ];

    protected $appends=['estate_type_name','city_name'];



    public function estate_type()
    {
        return $this->belongsTo(EstateType::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class,'serial_city');
    }

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }







    public function getEstateTypeNameAttribute()
    {


        return @$this->estate_type->name;
    }

    public function getCityNameAttribute()
    {


        return @$this->city->name;
    }









    public function getNationalAddressFileAttribute()
    {
        return url( (@$this->attributes['national_address_file']));
    }
    public function getIdentityFileAttribute()
    {
        return url( (@$this->attributes['identity_file']));
    }


}
