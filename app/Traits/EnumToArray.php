<?php

namespace App\Traits;

trait EnumToArray
{
    public static function names(): array
    {
        return array_column(self::cases(), 'name');
    }

    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    public static function toArray(): array
    {
        return array_combine(self::values(), self::names());
    }

    public static function toTitledArray(): array
    {
        return array_combine(self::values(), array_map(fn ($name) => str($name)->replace('_', ' ')->title()->value(), self::names()));
    }
}
