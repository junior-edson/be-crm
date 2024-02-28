<?php

namespace App\Enums;

enum EnumClientTaxType
{
    case TAX_6_PERCENT;
    case TAX_21_PERCENT;
    case SELF_LIQUIDATION;
    case SUBCONTRACTOR;

    /**
     * @return string
     */
    public function personTaxes(): string
    {
        return match ($this) {
            self::TAX_6_PERCENT => 'TAX_6_PERCENT',
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

    /**
     * @return array
     */
    public static function getValues(): array
    {
        return [
            self::TAX_6_PERCENT->personTaxes(),
            self::TAX_21_PERCENT->personTaxes(),
            self::SELF_LIQUIDATION->personTaxes(),
            self::SUBCONTRACTOR->companyTaxes(),
        ];
    }
}
