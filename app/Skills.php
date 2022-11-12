<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'list' ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'list' => 'array',
    ]; 
}
