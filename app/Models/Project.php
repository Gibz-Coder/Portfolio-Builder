<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image',
        'images',
        'demo_url',
        'github_url',
        'technologies',
        'status',
        'start_date',
        'end_date',
        'is_featured',
        'sort_order',
    ];

    protected $casts = [
        'images' => 'array',
        'technologies' => 'array',
        'start_date' => 'date',
        'end_date' => 'date',
        'is_featured' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
