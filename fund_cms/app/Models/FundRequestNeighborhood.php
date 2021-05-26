<?php

namespace App\Models;

use App\Models\FundRequest;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundRequestNeighborhood extends Model
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
    protected $table = 'fund_request_neighborhoods';
    protected $fillable = [
        'neighborhood_id',
        'request_fund_id',


    ];


    protected $appends = ['neighborhood_name'];


    public function fund_request()
    {
        return $this->belongsTo(FundRequest::class, 'request_fund_id');
    }

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class, 'neighborhood_id', 'neighborhood_serial');
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


}
