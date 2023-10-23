<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserProfile extends JsonResource
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
            'surname' => $this->surname,
            'occupation' => $this->occupation,
            'phone' => $this->phone,
            'address' => $this->address,
            'photo' => $this->photo,
            'website' => $this->website,
            'linkedin_url' => $this->linkedin_url,
            'professional_summary' => $this->professional_summary,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
