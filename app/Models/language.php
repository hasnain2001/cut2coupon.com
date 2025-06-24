<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class language extends Model
{
    protected $fillable = [
        'name',
        'code',
        'status',
        'created_at',
        'updated_at',
        'created_by',
        'updated_by',
        'flag',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function stores()
    {
        return $this->hasMany(Stores::class, );
    }
    public function categories()
    {
        return $this->hasMany(Category::class);
    }
    public function coupons()
    {
        return $this->hasMany(Coupon::class, );
    }
    public function blogs()
    {
        return $this->hasMany(Blog::class, );
    }
    public function sliders()
    {
        return $this->hasMany(Slider::class, );
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
