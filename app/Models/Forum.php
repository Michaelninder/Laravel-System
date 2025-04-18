<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    use HasFactory;

    protected $fillable = ['uuid', 'name', 'description', 'is_locked', 'order_index'];

    public function threads()
    {
        return $this->hasMany(ForumThread::class, 'forum_uuid', 'uuid');
    }
}
