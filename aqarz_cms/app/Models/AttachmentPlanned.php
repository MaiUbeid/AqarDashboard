<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttachmentPlanned extends Model
{
    /**
     * The attributes that are guarded from  mass assignable.
     *
     * @var array
     */
    // protected $connection = 'customer';
    use SoftDeletes;
    protected $table = 'attachment_planned';
    protected $guarded = [

    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'estate_id',
        'file',
    ];
    protected $appends = ['file_path'];

    public function getFileAttribute($value)
    {
        return url(($value));
    }


    public function getFilePathAttribute()
    {
        return $this->attributes['file'];
    }

}
