<?php

namespace App\Enums;

enum EnumClientType: string
{
    case INDIVIDUAL = 'INDIVIDUAL';
    case COMPANY = 'COMPANY';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
