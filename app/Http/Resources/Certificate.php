<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Carbon\Carbon;

class Certificate extends JsonResource
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
            'name' => $this->name,
            'organization' => $this->organization,
            'issued' => $this->issued,
            'issued_converted' => Carbon::createFromFormat('Y-m-d', $this->issued)->isoFormat('MMMM YYYY'),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
