<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NavItem extends Model
{
    protected $fillable = ['parent_id', 'level', 'label', 'href', 'sort_order', 'is_active'];

    protected $casts = ['is_active' => 'boolean'];

    public function children()
    {
        return $this->hasMany(NavItem::class, 'parent_id')->orderBy('sort_order');
    }

    public function parent()
    {
        return $this->belongsTo(NavItem::class, 'parent_id');
    }
}
