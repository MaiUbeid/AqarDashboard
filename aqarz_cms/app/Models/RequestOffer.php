<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RequestOffer extends Model
{

    use SoftDeletes;

    protected $table = 'request_offers';

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
        'user_id',
        'request_id',
        'instument_number',
        'guarantees',
        'beneficiary_name',
        'beneficiary_mobile',
        'status',
        'estate_id',
        'provider_id',


    ];
    protected $appends = ['rate'];
    protected $hidden = ['provider_id'];


    public function request()
    {
        return $this->belongsTo(EstateRequest::class, 'request_id');
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getRateAttribute()
    {

        $rate = RateOffer::where('offer_id', $this->id)->first();
        if ($rate) {
            return @$rate->rate;
        }
        else
        {
            return 0;
        }

    }


}
