<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Reminder extends Model
{
    protected $fillable = [
        'user_id',
        'learning_item_id',
        'remind_at',
        'type',
        'is_sent'
    ];

    protected $casts = [
        'remind_at' => 'datetime',
        'is_sent' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function learningItem()
    {
        return $this->belongsTo(LearningItem::class);
    }
}
