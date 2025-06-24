<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'image',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
    public function stores(): HasMany
    {
        return $this->hasMany(Stores::class, );
    }
    public function coupons(): HasMany
    {
        return $this->hasMany(Coupon::class, );
    }
    public function categories(): HasMany
    {
        return $this->hasMany(Category::class, );
    }
   

    public function blogs(): HasMany
    {
        return $this->hasMany(Blog::class, );
    }
    public function task(): HasMany
    {
        return $this->hasMany(Task::class, );
    }
    public function language(): HasMany
    {
        return $this->hasMany(Language::class, 'created_by');
    }
    public function updatedBy(): HasMany
    {
        return $this->hasMany(Language::class, 'updated_by');
    }

    // User.php
    public function checkin()
    {
        return $this->hasMany(CheckInOut::class);
    }



}
