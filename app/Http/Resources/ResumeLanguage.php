<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Language;
use App\Http\Resources\LanguageLevel;

class ResumeLanguage extends JsonResource
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
            'language_id' => $this->language_id,
            'language' => new Language($this->language),
            'level_id' => $this->level_id,
            'level' => new LanguageLevel($this->level),
        ];
    }
}
