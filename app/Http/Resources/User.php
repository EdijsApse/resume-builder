<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
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
            'email' => $this->email,
            'is_admin' => (bool)$this->is_admin,
            'resume_link' => route('resume.preview', ['hash' => $this->hash]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
