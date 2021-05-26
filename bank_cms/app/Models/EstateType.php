<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EstateType extends Model {


    protected $table='estate_types';


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
