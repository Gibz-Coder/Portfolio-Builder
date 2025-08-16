<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'bio',
        'phone',
        'location',
        'website',
        'avatar',
        'resume',
        'birth_date',
        'profession',
        'years_experience',
        'about_me',
    ];

    protected $casts = [
        'birth_date' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
