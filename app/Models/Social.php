<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    protected $fillable = [
        'user_id',
        'platform',
        'username',
        'url',
        'icon',
        'is_visible',
        'sort_order',
    ];

    protected $casts = [
        'is_visible' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
