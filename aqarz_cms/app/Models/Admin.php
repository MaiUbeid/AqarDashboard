<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Cashier\Billable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Support\Facades\Config;

class Admin extends Authenticatable
{
    use \Illuminate\Notifications\Notifiable;

    protected $table = 'admins';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    // public $timestamps = false;
    use SoftDeletes;
    protected $fillable = [

        'name',

        'email',
        'password',
        'mobile',
        'active_payment_link'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function sendPasswordResetNotification($token)
    {

        $this->notify(new ResetPasswordNotification($token));
    }




}