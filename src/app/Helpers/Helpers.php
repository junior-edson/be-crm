<?php

if (!function_exists('theme')) {
    function theme()
    {
        return app(App\Core\Theme::class);
    }
}


if (!function_exists('getName')) {
    /**
     * Get product name
     *
     * @return void
     */
    function getName()
    {
        return config('settings.KT_THEME');
    }
}


if (!function_exists('addHtmlAttribute')) {
    /**
     * Add HTML attributes by scope
     *
     * @param $scope
     * @param $name
     * @param $value
     *
     * @return void
     */
    function addHtmlAttribute($scope, $name, $value)
    {
        theme()->addHtmlAttribute($scope, $name, $value);
    }
}


if (!function_exists('addHtmlAttributes')) {
    /**
     * Add multiple HTML attributes by scope
     *
     * @param $scope
     * @param $attributes
     *
     * @return void
     */
    function addHtmlAttributes($scope, $attributes)
    {
        theme()->addHtmlAttributes($scope, $attributes);
    }
}


if (!function_exists('addHtmlClass')) {
    /**
     * Add HTML class by scope
     *
     * @param $scope
     * @param $value
     *
     * @return void
     */
    function addHtmlClass($scope, $value)
    {
        theme()->addHtmlClass($scope, $value);
    }
}


if (!function_exists('printHtmlAttributes')) {
    /**
     * Print HTML attributes for the HTML template
     *
     * @param $scope
     *
     * @return string
     */
    function printHtmlAttributes($scope)
    {
        return theme()->printHtmlAttributes($scope);
    }
}


if (!function_exists('printHtmlClasses')) {
    /**
     * Print HTML classes for the HTML template
     *
     * @param $scope
     * @param $full
     *
     * @return string
     */
    function printHtmlClasses($scope, $full = true)
    {
        return theme()->printHtmlClasses($scope, $full);
    }
}


if (!function_exists('getSvgIcon')) {
    /**
     * Get SVG icon content
     *
     * @param $path
     * @param $classNames
     * @param $folder
     *
     * @return string
     */
    function getSvgIcon($path, $classNames = 'svg-icon', $folder = 'assets/media/icons/')
    {
        return theme()->getSvgIcon($path, $classNames, $folder);
    }
}


if (!function_exists('setModeSwitch')) {
    /**
     * Set dark mode enabled status
     *
     * @param $flag
     *
     * @return void
     */
    function setModeSwitch($flag)
    {
        theme()->setModeSwitch($flag);
    }
}


if (!function_exists('isModeSwitchEnabled')) {
    /**
     * Check dark mode status
     *
     * @return void
     */
    function isModeSwitchEnabled()
    {
        return theme()->isModeSwitchEnabled();
    }
}


if (!function_exists('setModeDefault')) {
    /**
     * Set the mode to dark or light
     *
     * @param $mode
     *
     * @return void
     */
    function setModeDefault($mode)
    {
        theme()->setModeDefault($mode);
    }
}


if (!function_exists('getModeDefault')) {
    /**
     * Get current mode
     *
     * @return void
     */
    function getModeDefault()
    {
        return theme()->getModeDefault();
    }
}


if (!function_exists('setDirection')) {
    /**
     * Set style direction
     *
     * @param $direction
     *
     * @return void
     */
    function setDirection($direction)
    {
        theme()->setDirection($direction);
    }
}


if (!function_exists('getDirection')) {
    /**
     * Get style direction
     *
     * @return void
     */
    function getDirection()
    {
        return theme()->getDirection();
    }
}


if (!function_exists('isRtlDirection')) {
    /**
     * Check if style direction is RTL
     *
     * @return void
     */
    function isRtlDirection()
    {
        return theme()->isRtlDirection();
    }
}


if (!function_exists('extendCssFilename')) {
    /**
     * Extend CSS file name with RTL or dark mode
     *
     * @param $path
     *
     * @return void
     */
    function extendCssFilename($path)
    {
        return theme()->extendCssFilename($path);
    }
}


if (!function_exists('includeFavicon')) {
    /**
     * Include favicon from settings
     *
     * @return string
     */
    function includeFavicon()
    {
        return theme()->includeFavicon();
    }
}


if (!function_exists('includeFonts')) {
    /**
     * Include the fonts from settings
     *
     * @return string
     */
    function includeFonts()
    {
        return theme()->includeFonts();
    }
}


if (!function_exists('getGlobalAssets')) {
    /**
     * Get the global assets
     *
     * @param $type
     *
     * @return array
     */
    function getGlobalAssets($type = 'js')
    {
        return theme()->getGlobalAssets($type);
    }
}


if (!function_exists('addVendors')) {
    /**
     * Add multiple vendors to the page by name. Refer to settings KT_THEME_VENDORS
     *
     * @param $vendors
     *
     * @return void
     */
    function addVendors($vendors)
    {
        theme()->addVendors($vendors);
    }
}


if (!function_exists('addVendor')) {
    /**
     * Add single vendor to the page by name. Refer to settings KT_THEME_VENDORS
     *
     * @param $vendor
     *
     * @return void
     */
    function addVendor($vendor)
    {
        theme()->addVendor($vendor);
    }
}


if (!function_exists('addJavascriptFile')) {
    /**
     * Add custom javascript file to the page
     *
     * @param $file
     *
     * @return void
     */
    function addJavascriptFile($file)
    {
        theme()->addJavascriptFile($file);
    }
}


if (!function_exists('addCssFile')) {
    /**
     * Add custom CSS file to the page
     *
     * @param $file
     *
     * @return void
     */
    function addCssFile($file)
    {
        theme()->addCssFile($file);
    }
}


if (!function_exists('getVendors')) {
    /**
     * Get vendor files from settings. Refer to settings KT_THEME_VENDORS
     *
     * @param $type
     *
     * @return array
     */
    function getVendors($type)
    {
        return theme()->getVendors($type);
    }
}


if (!function_exists('getCustomJs')) {
    /**
     * Get custom js files from the settings
     *
     * @return array
     */
    function getCustomJs()
    {
        return theme()->getCustomJs();
    }
}


if (!function_exists('getCustomCss')) {
    /**
     * Get custom css files from the settings
     *
     * @return array
     */
    function getCustomCss()
    {
        return theme()->getCustomCss();
    }
}


if (!function_exists('getHtmlAttribute')) {
    /**
     * Get HTML attribute based on the scope
     *
     * @param $scope
     * @param $attribute
     *
     * @return array
     */
    function getHtmlAttribute($scope, $attribute)
    {
        return theme()->getHtmlAttribute($scope, $attribute);
    }
}


if (!function_exists('isUrl')) {
    /**
     * Get HTML attribute based on the scope
     *
     * @param $url
     *
     * @return mixed
     */
    function isUrl($url)
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }
}


if (!function_exists('image')) {
    /**
     * Get image url by path
     *
     * @param $path
     *
     * @return string
     */
    function image($path)
    {
        return asset('assets/media/'.$path);
    }
}


if (!function_exists('getIcon')) {
    /**
     * Get icon
     *
     * @param $path
     *
     * @return string
     */
    function getIcon($name, $class = '', $type = '', $tag = 'span')
    {
        return theme()->getIcon($name, $class, $type, $tag);
    }
}


if (!function_exists('getTaxName')) {
    function getTaxName($client): string
    {
        // Rule do update tax from 21% to 6%
        if (
            $client->tax_type === \App\Enums\EnumClientTaxType::TAX_21_PERCENT->personTaxes()
            && $client->is_building_older_than_10_years === 1
        ) {
            return \App\Enums\EnumClientTaxType::TAX_6_PERCENT->personTaxes();
        }

        // Autoliquidation, subcontractor, NPO, etc.
        return $client->tax_type;
    }
}


if (!function_exists('getClientTaxPercentage')) {
    function getClientTaxPercentage($client): int
    {
        // Tax 21%
        if (
            $client->tax_type === \App\Enums\EnumClientTaxType::TAX_21_PERCENT->personTaxes()
            && $client->is_building_older_than_10_years === 0
        ) {
            return 21;
        }

        // Tax 6%
        if (
            $client->tax_type === \App\Enums\EnumClientTaxType::TAX_21_PERCENT->personTaxes()
            && $client->is_building_older_than_10_years === 1
        ) {
            return 6;
        }

        // Autoliquidation, subcontractor, NPO, etc.
        return 0;
    }
}


if (!function_exists('getTaxPercentage')) {
    function getTaxPercentage($tax): int
    {
        if ($tax === \App\Enums\EnumClientTaxType::TAX_21_PERCENT->personTaxes()) {
            return 21;
        }

        if ($tax === \App\Enums\EnumClientTaxType::TAX_6_PERCENT->personTaxes()) {
            return 6;
        }

        return 0;
    }
}


if (!function_exists('getQuotationColor')) {
    function getQuotationColor($status): string
    {
        if ($status === \App\Enums\EnumQuotationStatus::DRAFT->value) {
            return 'dark';
        }

        if ($status === \App\Enums\EnumQuotationStatus::PENDING->value) {
            return 'warning';
        }

        if ($status === \App\Enums\EnumQuotationStatus::SENT->value) {
            return 'primary';
        }

        if ($status === \App\Enums\EnumQuotationStatus::APPROVED->value) {
            return 'success';
        }

        if ($status === \App\Enums\EnumQuotationStatus::REJECTED->value) {
            return 'danger';
        }

        return 'light';
    }
}


if (!function_exists('moneyFormat')) {
    function moneyFormat($value, $currency = 'EUR', $decimals = 2, $dec_point = ',', $thousands_sep = '.'): string
    {
        $arrayCurrency = [
            'EUR' => '€ ',
            'USD' => 'U$ ',
            'GBP' => '£ ',
            'BRL' => 'R$ ',
        ];

        $prefix = $currency !== null ? $arrayCurrency[$currency] : null;

        return $prefix . number_format($value, $decimals, $dec_point, $thousands_sep);
    }
}


if (!function_exists('getItemsTotalAmount')) {
    function getItemsTotalAmount($items): float
    {
        $total = 0;

        foreach ($items as $item) {
            $total += $item->unit_price * $item->quantity;
        }

        return $total;
    }
}


if (!function_exists('getTaxAmount')) {
    function getTaxAmount($value, $taxType): float
    {
        $percentage = getTaxPercentage($taxType);
        return $value * $percentage / 100;
    }
}


if (!function_exists('dateFormat')) {
    function dateFormat($date, $toBeSaved = false): string
    {
        if ($toBeSaved) {
            return \Carbon\Carbon::createFromFormat('d/m/Y', $date)->format('Y-m-d');
        }

        return \Carbon\Carbon::parse($date)->format('d/m/Y');
    }
}


if (!function_exists('addressLineBreaker')) {
    function addressLineBreaker($address): string
    {
        return preg_replace('/(\D|^)(\d{4})/', "$1<br>$2", $address);
    }
}
