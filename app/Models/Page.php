<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'label',
        'subtitle',
        'heading',
        'cta_text',
        'cta_url',
        'image',
        'content',
        'nav_group',
        'nav_sub',
        'nav_label',
        'show_in_nav',
        'show_inquiry',
        'is_published',
        'published_at',
    ];

    protected $casts = [
        'show_in_nav'  => 'boolean',
        'show_inquiry'  => 'boolean',
        'is_published' => 'boolean',
        'published_at' => 'datetime',
    ];
}
