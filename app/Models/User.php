<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
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
        'is_active',
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
            'is_active' => 'boolean',
        ];
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Get the user's avatar URL or return null if no avatar exists
     */
    public function getAvatarUrlAttribute()
    {
        // Check if profile relationship is loaded to avoid N+1 queries
        if ($this->relationLoaded('profile') && $this->profile && $this->profile->avatar) {
            return \Storage::url($this->profile->avatar);
        }

        // If profile is not loaded, load it once and check
        if (!$this->relationLoaded('profile')) {
            $this->load('profile');
            if ($this->profile && $this->profile->avatar) {
                return \Storage::url($this->profile->avatar);
            }
        }

        return null;
    }

    public function skills()
    {
        return $this->hasMany(Skill::class);
    }

    public function education()
    {
        return $this->hasMany(Education::class);
    }

    public function experiences()
    {
        return $this->hasMany(Experience::class);
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class);
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function socials()
    {
        return $this->hasMany(Social::class);
    }
}
