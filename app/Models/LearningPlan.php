<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LearningPlan extends Model
{
    /** @use HasFactory<\Database\Factories\LearningPlanFactory> */
    use HasFactory;

    protected $fillable = ['user_id', 'mentor_id', 'title', 'status', 'content'];

    protected $casts = [
        'content' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function mentor()
    {
        return $this->belongsTo(User::class, 'mentor_id');
    }

    public function items()
    {
        return $this->hasMany(LearningItem::class)->orderBy('order');
    }
}
