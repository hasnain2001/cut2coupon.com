<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Employee extends Model
{
    protected $table = 'users';


        public function employee(): HasMany
    {
        return $this->hasMany(User::class, );
    }

        public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

            protected static function booted()
    {
        static::addGlobalScope('employee', function ($query) {
            $query->where('role', 'admin');
        });
    }
}
