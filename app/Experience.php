<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $guarded = [
        'user_id'
    ];

    /**
     * Returns human readable date from
     *
     * @return string
     */
    public function getDateFromForHumansAttribute()
    {
        if ($this->from) {
            return Carbon::createFromFormat('Y-m-d', $this->from)->isoFormat('MMMM YYYY');
        }
        return null;
    }

    /**
     * Returns human readable date to
     *
     * @return string
     */
    public function getDateToForHumansAttribute()
    {
        if ($this->to) {
            return Carbon::createFromFormat('Y-m-d', $this->to)->isoFormat('MMMM YYYY');
        }
        return null;
    }
}
