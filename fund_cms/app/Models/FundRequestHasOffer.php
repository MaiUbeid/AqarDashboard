<?php

namespace App\Models;


use App\Models\FundRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundRequestHasOffer extends Model
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
    protected $table = 'fund_request_has_offers';
    protected $fillable = [
        'display_status',
        'uuid',


    ];


  protected $hidden=['status','updated_at','deleted_at','id'];


    public function fund_request()
    {
        return $this->belongsTo(FundRequest::class, 'uuid');
    }


    public function getDisplayStatusAttribute($value)
    {
        return __('views.'.$value);
    }




}
