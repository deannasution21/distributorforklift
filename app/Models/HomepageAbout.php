<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageAbout extends Model
{
    protected $fillable = [
        'section_title',
        'title',
        'description',
        'box_title',
        'box_description',
        'image',
        'show_cta',
        'cta_text',
        'cta_url',
        'long_description',
    ];

    protected $casts = [
        'show_cta' => 'boolean',
    ];
}
