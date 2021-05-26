<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RateRequestTypeRate extends Model
{
    /**
     * The attributes that are guarded from  mass assignable.
     *
     * @var array
     */
    // protected $connection = 'customer';

    protected $table='rate_request_type_rates';
    protected $guarded = [

    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'rate_request_id',
        'rate_request_type_id',
    ];


}
