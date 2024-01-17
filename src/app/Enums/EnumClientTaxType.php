<?php

namespace App\Enums;

enum EnumClientTaxType
{
    case TAX_21_PERCENT;
    case SELF_LIQUIDATION;
    case SUBCONTRACTOR;

    /**
     * @return string
     */
    public function personTaxes(): string
    {
        return match ($this) {
            self::TAX_21_PERCENT => 'TAX_21_PERCENT',
            self::SELF_LIQUIDATION => 'SELF_LIQUIDATION',
        };
    }

    /**
     * @return string
     */
    public function companyTaxes(): string
    {
        return match ($this) {
            self::SUBCONTRACTOR => 'SUBCONTRACTOR',
            self::SELF_LIQUIDATION => 'SELF_LIQUIDATION',
        };
    }
}
