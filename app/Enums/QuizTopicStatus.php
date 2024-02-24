<?php

namespace App\Enums;

enum QuizTopicStatus
{
    case Online;
    case Offline;
    case Marks;

    public function color(): string
    {
        return match ($this) {
            QuizTopicStatus::Online => 'danger',
            QuizTopicStatus::Offline => 'warning',
            QuizTopicStatus::Marks => 'success',
        };
    }

    public static function colors(): array
    {
        return [
            'danger' => 'Online',
            'warning' => 'Offline',
            'success' => 'Marks',
        ];
    }

    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function array(): array
    {
        return array_combine(self::names(), self::names());
    }
}
