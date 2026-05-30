<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomepageShowcase extends Model
{
    protected $fillable = ['row', 'position', 'title', 'description', 'image', 'href'];
}
