<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DeleteRequest extends Model
{
    protected $table = 'delete_requests';
    protected $fillable = [
        'store_id',
        'user_id',
        'status',
    ];

    public function store()
    {
        return $this->belongsTo(Stores::class);
    }

    public function employee()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
