<?php

namespace App\Enums;

enum EnumQuotationStatus: string
{
    case DRAFT = 'DRAFT';
    case PENDING = 'PENDING';
    case SENT = 'SENT';
    case APPROVED = 'APPROVED';
    case REJECTED = 'REJECTED';

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return array_column(self::cases(), 'value');
    }
}
