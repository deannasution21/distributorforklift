<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSlider extends Model
{
    protected $fillable = [
        'label',
        'title',
        'description',
        'show_cta',
        'cta_text',
        'cta_url',
        'image',
        'order',
        'is_active',
    ];

    protected $casts = [
        'show_cta' => 'boolean',
        'is_active' => 'boolean',
        'order' => 'integer',
    ];
}
