<?php

namespace App\Models;

use App\Models\FundRequest;
use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundRequestOffer extends Model
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
        'uuid',
        'instument_number',
        'guarantees',
        'beneficiary_name',
        'beneficiary_mobile',
        'status',
        'estate_id',
        'provider_id',


    ];

    protected $hidden = ['provider_id'];



    public function fund_request()
    {
        return $this->belongsTo(FundRequest::class, 'uuid','uuid');
    }

    public function estate()
    {
        return $this->belongsTo(Estate::class, 'estate_id');
    }

    public function provider()
    {
        return $this->belongsTo(User::class, 'provider_id');
    }




}
