<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumComment extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'thread_uuid', 'user_uuid', 'body'];

    public function thread()
    {
        return $this->belongsTo(ForumThread::class, 'thread_uuid', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }

    public function votes()
    {
        return $this->hasMany(ForumVote::class, 'comment_uuid', 'uuid');
    }
}
