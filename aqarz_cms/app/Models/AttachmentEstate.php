<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttachmentEstate extends Model
{
    /**
     * The attributes that are guarded from  mass assignable.
     *
     * @var array
     */
    // protected $connection = 'customer';

    protected $table = 'attachment_estate';
    protected $guarded = [

    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use SoftDeletes;
    protected $fillable = [
        'estate_id',
        'file',
    ];

    public function getFileAttribute()
    {
        return url( (@$this->attributes['file']));
    }

    public function getFilePathAttribute()
    {
        return $this->attributes['file'];
    }

}
