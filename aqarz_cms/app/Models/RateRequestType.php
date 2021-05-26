<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RateRequestType extends Model
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

    protected $table='rate_request_types';
    protected $fillable = [

    ];

    protected $appends=['name'];
    public function getNameAttribute()
    {
        $locale='ar';
        if(app('request')->hasCookie('locale')) {
            $locale = app('request')->cookie('locale');

        }

        $colum_name='name_'.$locale;
        return $this->$colum_name;
    }
   
}
