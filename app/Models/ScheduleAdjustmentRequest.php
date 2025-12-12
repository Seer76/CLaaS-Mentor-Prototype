<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleAdjustmentRequest extends Model
{
    protected $fillable = [
        'user_id',
        'learning_item_id',
        'request_type',
        'reason',
        'current_date',
        'requested_date',
        'status',
        'reviewed_by',
        'review_notes',
        'reviewed_at'
    ];

    protected $casts = [
        'current_date' => 'date',
        'requested_date' => 'date',
        'reviewed_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function learningItem()
    {
        return $this->belongsTo(LearningItem::class);
    }

    public function reviewer()
    {
        return $this->belongsTo(User::class, 'reviewed_by');
    }
}
