<?php

namespace App\DataTransferObjects;


use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\MapName;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;

#[OA\Schema(
    schema: 'PropertyData',
    description: 'Property data',
    properties: [
        new OA\Property(property: 'id', type: 'integer', example: 1),
        new OA\Property(property: 'name', type: 'string', example: 'The Skyscape'),
        new OA\Property(property: 'bedrooms', type: 'integer', example: 3),
        new OA\Property(property: 'bathrooms', type: 'integer', example: 2),
        new OA\Property(property: 'storeys', type: 'integer', example: 2),
        new OA\Property(property: 'garages', type: 'integer', example: 1),
        new OA\Property(property: 'price', type: 'integer', example: 500000)
    ],
    type: 'object'
)]
#[MapName(SnakeCaseMapper::class)]
class PropertyData extends Data
{
    public function __construct(
        public int             $id,
        public readonly string $name,
        public readonly int    $bedrooms,
        public readonly int    $bathrooms,
        public readonly int    $storeys,
        public readonly int    $garages,
        public readonly int    $price
    )
    {
    }
}
