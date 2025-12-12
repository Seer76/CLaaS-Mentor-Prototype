<?php

namespace App\Enums;

enum UserRole: string
{
    case LEARNER = 'learner';
    case MENTOR = 'mentor';
    case MANAGER = 'manager';
    case ADMIN = 'admin';

    public function label(): string
    {
        return match($this) {
            self::LEARNER => 'Learner',
            self::MENTOR => 'Mentor',
            self::MANAGER => 'Manager',
            self::ADMIN => 'Administrator',
        };
    }
}
