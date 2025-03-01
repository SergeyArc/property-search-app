<?php

namespace App\Enums;

use App\Filters\{
    NameFilter, BedroomsFilter, BathroomsFilter, StoreysFilter, GaragesFilter, PriceMinFilter, PriceMaxFilter
};
use App\Filters\Filter;

enum Filters: string
{
    case NAME = 'name';
    case BEDROOMS = 'bedrooms';
    case BATHROOMS = 'bathrooms';
    case STOREYS = 'storeys';
    case GARAGES = 'garages';
    case PRICE_MIN = 'price_min';
    case PRICE_MAX = 'price_max';

    public function createFilter(mixed $value): Filter
    {
        return match ($this) {
            self::NAME => new NameFilter($value),
            self::BEDROOMS => new BedroomsFilter($value),
            self::BATHROOMS => new BathroomsFilter($value),
            self::STOREYS => new StoreysFilter($value),
            self::GARAGES => new GaragesFilter($value),
            self::PRICE_MIN => new PriceMinFilter($value),
            self::PRICE_MAX => new PriceMaxFilter($value),
        };
    }
}
