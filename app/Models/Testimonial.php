<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    protected $fillable = [
        'user_id',
        'client_name',
        'client_position',
        'client_company',
        'client_avatar',
        'content',
        'rating',
        'project_title',
        'is_featured',
        'is_approved',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
