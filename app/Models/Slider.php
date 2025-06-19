<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Slider extends Model
{
    protected $table = 'sliders';

    protected $fillable = [
        'title',
        'subtitle',
        'image',
        'link',
        'status',
        'sort_order',
        'button_text',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? asset('uploads/slider/' . $this->image) : null;
    }
    public function setImageAttribute($value)
    {
        if (is_string($value)) {
            $this->attributes['image'] = $value;
        } elseif ($value && $value->isValid()) {
            $imageName = time() . '_' . Str::slug($this->title) . '.' . $value->getClientOriginalExtension();
            $value->move(public_path('uploads/slider'), $imageName);
            $this->attributes['image'] = $imageName;
        }
    }
}
