<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'user_id',
        'update_id',
        'name',
        'slug',
        'top_category',
        'status',
        'image',
        'title',
        'meta_keyword',
        'meta_description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function stores() : HasMany
    {
        return $this->hasMany(stores::class,);
    }
    public function blogs() : HasMany
    {
        return $this->hasMany(Blog::class);
    }

}
