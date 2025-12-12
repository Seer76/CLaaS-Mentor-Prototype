<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSkill extends Model
{
    protected $fillable = [
        'user_id',
        'skill_id',
        'learning_item_id',
        'proficiency_level',
        'progress_percent',
        'acquired_at'
    ];

    protected $casts = [
        'acquired_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function skill()
    {
        return $this->belongsTo(Skill::class);
    }

    public function learningItem()
    {
        return $this->belongsTo(LearningItem::class);
    }
}
