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
        'post_image',
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

    public function getPostImageURL()
    {
        if($this->post_image)
        {
           return url('storage/'.$this->post_image);
        }
        return null;
    }

    public static function getTotalCount()
    {
        return self::count();
    }
}
