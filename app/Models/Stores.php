<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stores extends Model
{
    protected $fillable = [
        'user_id',
        'category_id',
        'name',
        'url',
        'destination_url',
        'top_store',
        'description',
        'about',
        'network',
        'slug',
        'top_category',
        'status',
        'image',
        'title',
        'meta_keyword',
        'meta_description',
        'created_at',
        'updated_at',
        'deleted_at',
        'content',
        'updated_id',
    ];
    protected $dates = [
    'updated_at',
    'created_at',
    // any other date fields
];
    protected $casts = [
    'updated_at' => 'datetime',
    'created_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function updatedby()
    {
        return $this->belongsTo(User::class, 'updated_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function coupons()
    {
        return $this->hasMany(Coupon::class, 'store_id');
    }
}
