<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
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
        'serial_city',
        'name_ar',
        'name_en'
    ];

    protected $appends = ['name'];

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
