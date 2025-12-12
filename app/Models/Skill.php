<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserSkill;

class Skill extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'category', 'description', 'level'];

    public function userSkills()
    {
        return $this->hasMany(UserSkill::class);
    }
}
