<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class RateRequest extends Model
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
        'name',
        'email',
        'mobile',
        'note',
        'lat',
        'lan',
        'status',
        'user_id'
    ];

    protected $appends = ['operation_type_name'];

    public function operation_type()
    {
        return $this->belongsTo(OprationType::class);
    }



    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


    public function getOperationTypeNameAttribute()
    {


        return $this->operation_type->name;
    }







    public function rate_request_types()
    {
        return $this->belongsToMany(RateRequestType::class, 'rate_request_type_rates', 'rate_request_id');
    }
}
