<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $guarded = [
        'user_id'
    ];

    protected $table = 'user_profile';

}
