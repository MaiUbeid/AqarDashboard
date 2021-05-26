<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class EstateRequest extends Model
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
        'request_type',
        'estate_type_id',
        'area_from',
        'area_to',
        'price_from',
        'price_to',
        'room_numbers',
        'owner_name',
        'owner_mobile',
        'display_owner_mobile',
        'note',
        'lat',
        'lan',
        'status',
        'user_id',
        'seen_count',
        'neighborhood_id',
        'city_id',
        'address'
    ];

    protected $appends = ['in_fav','operation_type_name', 'estate_type_name','city_name', 'neighborhood_name'];

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


        return $this->operation_type->name;
    }

    public function getEstateTypeNameAttribute()
    {


        return $this->estate_type->name;
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


    public function getInFavAttribute()
    {


        $fav=Favorite::where('type_id',$this->id)
            ->where('type','request')
            ->where('status','1')
            ->first();
        if($fav)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function getLatAttribute($value)
    {
        return number_format((float)$value, 5, '.', '');

    }

    public function getLanAttribute($value)
    {
        return number_format((float)$value, 5, '.', '');

    }

    public function offers()
    {
        return $this->hasMany(RequestOffer::class,'request_id');
    }


}
