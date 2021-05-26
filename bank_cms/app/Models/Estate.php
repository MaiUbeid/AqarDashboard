<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Estate extends Model
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
        'instrument_number',
        'instrument_file',
        'pace_number',
        'planned_number',
        'total_area',
        'estate_age',
        'floor_number',
        'street_view',
        'total_price',
        'meter_price',
        'owner_name',
        'owner_mobile',
        'lounges_number',
        'rooms_number',
        'bathrooms_number',
        'boards_number',
        'kitchen_number',
        'dining_rooms_number',
        'finishing_type',
        'interface',
        'social_status',
        'lat',
        'lan',
        'note',
        'status',
        'user_id',
        'is_rent',
        'rent_type',
        'is_resident',
        'is_checked',
        'is_insured',
        'exclusive_contract_file',
        'neighborhood_id',
        'city_id',
        'address',
        'exclusive_marketing'
    ];


    protected $casts = [
        'lat'=>'float',
        'lan'=>'float',
    ];

    protected $appends = ['link','operation_type_name', 'estate_type_name','first_image','city_name', 'neighborhood_name','estate_type_name_web','city_name_web','neighborhood_name_web'];

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
        return $this->belongsTo(User::class, 'user_id');
    }


    public function getOperationTypeNameAttribute()
    {


        return @$this->operation_type->name;
    }

    public function city()
    {
        return $this->belongsTo(City::class,'city_id','serial_city');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class,'neighborhood_id','neighborhood_serial');
    }




    public function getEstateTypeNameAttribute()
    {


        return @$this->estate_type->name;
    }

    public function getEstateTypeNameWebAttribute()
    {


        return $this->estate_type->name_ar;
    }
    public function getInstrumentFileAttribute()
    {
        return url((@$this->attributes['instrument_file']));
    }




    public function getExclusiveContractFileAttribute($value)
    {
        if ($value) {
            return url($value);
        }
    }

    public function getFirstImageAttribute()
    {

        $img = AttachmentEstate::where('estate_id', $this->id)->first();
        if ($img) {
            return $img->file;
        }
    }

    public function plannedFile()
    {
        return $this->hasMany(AttachmentPlanned::class, 'estate_id');
    }

    public function EstateFile()
    {
        return $this->hasMany(AttachmentEstate::class, 'estate_id');
    }

    public function comforts()
    {
        return $this->belongsToMany(Comfort::class, 'estate_comforts', 'estate_id');
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




    public function getNeighborhoodNameWebAttribute()
    {

        $neighborhood = Neighborhood::where('neighborhood_serial', $this->neighborhood_id)
            ->first();
        if ($neighborhood) {
            return $neighborhood->name_ar;
        }

        return null;

    }


    public function getCityNameWebAttribute()
    {

        $city = City::where('serial_city', $this->city_id)->first();
        if ($city) {
            return $city->name_ar;
        }

        return null;

    }


    public function getLinkAttribute()
    {


        return url('estate/'.$this->id.'/show');

    }
}
