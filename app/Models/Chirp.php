<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Chirp extends Model
{
    use HasFactory;

    protected $fillable = [
        'message',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'chirp_likes')->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class,'chirp_id');
    }
}
