<?php

namespace App\DataTransferObjects;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Attributes\Validation\Min;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[OA\Schema(
    schema: 'FilterData',
    description: 'Filter data for property search',
    properties: [
        new OA\Property(property: 'name', description: 'The name of the property to search for', type: 'string', example: 'The Skyscape'),
        new OA\Property(property: 'bedrooms', description: 'number of bedrooms', type: 'integer', example: 3),
        new OA\Property(property: 'bathrooms', description: 'number of bathrooms', type: 'integer', example: 2),
        new OA\Property(property: 'storeys', description: 'number of storeys', type: 'integer', example: 1),
        new OA\Property(property: 'garages', description: 'number of garages', type: 'integer', example: 1),
        new OA\Property(property: 'price_min', description: 'Minimum property price', type: 'integer', example: 1000000),
        new OA\Property(property: 'price_max', description: 'Maximum property price', type: 'integer', example: 5000000),
    ],
    type: 'object'
)]
#[MapName(SnakeCaseMapper::class)]
class FilterData extends Data
{
    public function __construct(
        public readonly ?string $name = null,
        #[Min(0)]
        public readonly ?int $bedrooms = null,
        #[Min(0)]
        public readonly ?int $bathrooms = null,
        #[Min(0)]
        public readonly ?int $storeys = null,
        #[Min(0)]
        public readonly ?int $garages = null,
        #[Min(0)]
        public readonly ?int $priceMin = null,
        #[Min(0)]
        public readonly ?int $priceMax = null,
    ) {}
}
