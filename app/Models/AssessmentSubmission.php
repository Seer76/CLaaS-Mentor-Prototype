<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssessmentSubmission extends Model
{
    protected $fillable = [
        'assessment_id',
        'user_id',
        'score',
        'feedback',
        'status'
    ];

    public function assessment()
    {
        return $this->belongsTo(Assessment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
