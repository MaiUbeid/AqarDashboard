<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ComfortEstate extends Model
{
    /**
     * The attributes that are guarded from  mass assignable.
     *
     * @var array
     */
    // protected $connection = 'customer';

    protected $table='estate_comforts';
    protected $guarded = [

    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estate_id',
        'comfort_id',
    ];


}
