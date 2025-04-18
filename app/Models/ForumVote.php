<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ForumVote extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'comment_uuid', 'user_uuid', 'is_upvote'];

    public function comment()
    {
        return $this->belongsTo(ForumComment::class, 'comment_uuid', 'uuid');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_uuid', 'uuid');
    }
}
