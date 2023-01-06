<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Experience extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'jobtitle' => $this->jobtitle,
            'employer' => $this->employer,
            'from_converted' => $this->date_from_for_humans,
            'to_converted' => $this->date_to_for_humans,
            'from' => $this->from,
            'to' => $this->to,
            'is_current' => $this->is_current,
            'duties' => $this->duties,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
