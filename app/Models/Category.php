<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    protected $fillable = [
        'user_id',
        'updated_id',
        'name',
        'slug',
        'top_category',
        'status',
        'image',
        'title',
        'meta_keyword',
        'meta_description',
        'language_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }

    public function stores() : HasMany
    {
        return $this->hasMany(stores::class,);
    }
    public function blogs() : HasMany
    {
        return $this->hasMany(Blog::class);
    }
    public function language()
    {
        return $this->belongsTo(language::class);
    }
}

