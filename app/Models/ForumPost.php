<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ForumPost extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'category',
        'is_pinned',
        'views_count'
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function replies()
    {
        return $this->hasMany(ForumReply::class)->whereNull('parent_id')->with('children');
    }

    public function allReplies()
    {
        return $this->hasMany(ForumReply::class);
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }
}
