<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Education extends JsonResource
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
            'school' => $this->school,
            'degree' => $this->degree,
            'field' => $this->field,
            'from_converted' => Carbon::createFromFormat('Y-m-d', $this->from)->isoFormat('MMMM YYYY'),
            'to_converted' => $this->to ? Carbon::createFromFormat('Y-m-d', $this->to)->isoFormat('MMMM YYYY') : '',
            'from' => $this->from,
            'to' => $this->to,
            'is_current' => $this->is_current,
            'summary' => $this->summary,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
