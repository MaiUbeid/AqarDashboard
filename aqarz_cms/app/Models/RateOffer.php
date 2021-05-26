<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RateOffer extends Model
{

    use SoftDeletes;

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
        'offer_id',
        'user_id',
        'request_id',
        'provider_id',
        'rate',
        'note'


    ];
    protected $appends = ['user_name'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }
    public function offer()
    {
        return $this->belongsTo(RequestOffer::class, 'offer_id');
    }

    public function request()
    {
        return $this->belongsTo(EstateRequest::class, 'request_id');
    }


    public function getUserNameAttribute()
    {


        return @$this->user->name;
    }

    public function geProviderNameAttribute()
    {


        return @$this->provider->name;
    }


}
