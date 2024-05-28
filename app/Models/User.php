<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'bio',
        'image',
        'email',
        'password',
    ];
    

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
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

    public function getProfilePicURL()
    {
        if($this->image)
        {
           return url('storage/'.$this->image);
        }
        return 'https://i.pinimg.com/474x/b9/68/3d/b9683d3fe3f25bca278364f64f215c2a.jpg';
    }

    public function chirps(): HasMany
    {
        return $this->hasMany(Chirp::class)->orderBy("created_at","DESC");
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class)->orderBy("created_at","DESC");
    }

    public function likes()
    {
        return $this->belongsToMany(Chirp::class, 'chirp_likes')->withTimestamps();
    }

    public function likesChirp(Chirp $chirp)
    {
        return $this->likes()->where('chirp_id', $chirp->id)->exists();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'followers', 'user_id', 'follower_id')->withTimestamps();
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'followers', 'follower_id', 'user_id')->withTimestamps();
    }

    public function isFollowing(User $user)
    {
        return $this->followings()->where('user_id', $user->id)->exists();
    }

}
