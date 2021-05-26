<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Scope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Auth;

class VisibleScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $builder
     * @param  \Illuminate\Database\Eloquent\Model  $model
     * @return void
     */
    public function apply(Builder $builder, Model $model)
    {   
       
       if(! request()->is('/panel/admin/*')){
        $user_id = 0;
        if( Auth::check() )
        $user_id = Auth::id();
            
        $builder->whereRaw('( type="public" and user_id != '.$user_id.') or (user_id = '.$user_id.') '  );
        }
    }
}