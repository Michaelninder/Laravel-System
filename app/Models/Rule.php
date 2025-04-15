<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Rule extends Model
{
    protected $fillable = ['uuid', 'title', 'content', 'order_index'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($rule) {
            $rule->uuid = (string) Str::uuid();
        });
    }
}
