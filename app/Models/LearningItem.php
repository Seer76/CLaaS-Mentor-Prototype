<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LearningItem extends Model
{
    protected $fillable = [
        'learning_plan_id',
        'title',
        'type',
        'content_url',
        'description',
        'due_date',
        'order'
    ];

    protected $casts = [
        'due_date' => 'date',
    ];

    public function learningPlan()
    {
        return $this->belongsTo(LearningPlan::class);
    }

    public function progress()
    {
        return $this->hasMany(LearningProgress::class);
    }

    public function userProgress()
    {
        return $this->hasOne(LearningProgress::class)->where('user_id', auth()->id());
    }
}
