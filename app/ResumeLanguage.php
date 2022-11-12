<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResumeLanguage extends Model
{
    protected $guarded = [
        'user_id'
    ];

    public function level() {
        return $this->belongsTo(LanguageLevel::class);
    }

    public function language() {
        return $this->belongsTo(Language::class);
    }
}
