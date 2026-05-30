<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    protected $table = 'site_settings';

    protected $fillable = ['phone', 'whatsapp', 'email', 'address', 'youtube', 'instagram', 'tiktok', 'facebook', 'showcase_heading'];
}
