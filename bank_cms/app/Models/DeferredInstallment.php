<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class DeferredInstallment extends Model
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
        'contract_interval',

        'rent_price',
        'owner_name',
        'owner_mobile',
        'owner_identity_number',
        'owner_identity_file',
        'tenant_name',
        'tenant_mobile',
        'tenant_identity_number',
        'tenant_identity_file',
        'tenant_birthday',


        'tenant_city_id',
        'tenant_job_type',
        'tenant_job_start_date',
        'tenant_total_salary',
        'tenant_salary_bank_id',
        'tenant_engagements',
        'national_address',
        'national_address_file',
        'building_number',
        'street_name',
        'neighborhood_name',
        'building_city_name',
        'postal_code',
        'status',
        'user_id',
        'unit_name',
        'tenant_mobile_tow',
        'city_id',
        'neighborhood_id',
        'estate_id',
        'is_salary_adapter_on',
        'employer_name'

    ];

    protected $appends=['operation_type_name',
        'estate_type_name','tenant_city_name','city_name', 'neighborhood_name',
    'bank_name',
    ];

    protected $hidden=[
        'owner_name',
        'owner_mobile',
        'owner_identity_number',
        'owner_identity_file',
        'national_address',
        'tenant_engagements',
        'tenant_job_start_date',

    ];
    public function operation_type()
    {
        return $this->belongsTo(OprationType::class);
    }

    public function estate_type()
    {
        return $this->belongsTo(EstateType::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function tenant_city()
    {
        return $this->belongsTo(City::class,'tenant_city_id');
    }


    public function tenant_bank()
    {
        return $this->belongsTo(Bank::class,'tenant_salary_bank_id');
    }


    public function getOperationTypeNameAttribute()
    {


        return @$this->operation_type->name;
    }

    public function getBankNameAttribute()
    {


        return @$this->tenant_bank->name_ar;
    }
    public function getEstateTypeNameAttribute()
    {


        return @$this->estate_type->name;
    }

    public function getTenantCityNameAttribute()
    {


        return @$this->tenant_city->name;
    }

    /*public function getTenantBankNameAttribute()
    {


        return $this->tenant_bank->name;
    }*/





    public function getNationalAddressFileAttribute()
    {
        return url( (@$this->attributes['national_address_file']));
    }
    public function getOwnerIdentityFileAttribute()
    {
        return url( (@$this->attributes['owner_identity_file']));
    }
    public function getTenantIdentityFileAttribute()
    {
        return url( (@$this->attributes['tenant_identity_file']));
    }


    public function city()
    {
        return $this->belongsTo(City::class,'city_id','serial_city');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class,'neighborhood_id','neighborhood_serial');
    }


    public function getNeighborhoodNameAttribute()
    {

        $neighborhood = Neighborhood::where('neighborhood_serial', $this->neighborhood_id)
            ->first();
        if ($neighborhood) {
            return @$neighborhood->name;
        }

        return null;

    }


    public function getCityNameAttribute()
    {

        $city = City::where('serial_city', $this->city_id)->first();
        if ($city) {
            return @$city->name;
        }

        return null;

    }

}
