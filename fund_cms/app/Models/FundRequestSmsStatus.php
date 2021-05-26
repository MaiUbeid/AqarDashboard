<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FundRequestSmsStatus extends Model
{

    use SoftDeletes;
    protected $table = 'fund_request_sms_status';
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
        'request_id',
        'status',
        'error_msg',
        'code'


    ];

    public function fund_request_name()
    {
        return $this->belongsTo(FundRequest::class, 'uuid', 'uuid');
    }


}
