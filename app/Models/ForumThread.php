<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumThread extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'forum_uuid', 'user_uuid', 'title', 'is_pinned', 'is_locked', 'views'];

    public function forum()
    {
        return $this->belongsTo(Forum::class, 'forum_uuid', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    public function comments()
    {
        return $this->hasMany(ForumComment::class, 'thread_uuid', 'uuid');
    }
}
