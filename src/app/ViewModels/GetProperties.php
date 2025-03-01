<?php

namespace App\ViewModels;

use App\DataTransferObjects\FilterData;
use App\DataTransferObjects\PropertyData;
use App\Enums\Filters;
use App\Models\Property;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pipeline\Pipeline;
use OpenApi\Attributes as OA;

#[OA\Get(
    path: '/properties',
    description: 'Get a list of properties',
    tags: ['properties'],
    parameters: [
        new OA\Parameter(
            name: 'page',
            description: 'Current page',
            in: 'query',
            required: false,
            schema: new OA\Schema(type: 'integer', example: 1)
        ),
        new OA\Parameter(
            name: 'filter',
            description: 'Filter for property search',
            in: 'query',
            required: false,
            schema: new OA\Schema(ref: '#/components/schemas/FilterData')
        ),
    ],
    responses: [
        new OA\Response(
            response: 200,
            description: 'success',
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(
                        property: 'data',
                        type: 'array',
                        items: new OA\Items(ref: '#/components/schemas/PropertyData')
                    ),
                    new OA\Property(property: 'total', type: 'integer', example: 100),
                    new OA\Property(property: 'per_page', type: 'integer', example: 20),
                    new OA\Property(property: 'current_page', type: 'integer', example: 1),
                    new OA\Property(property: 'last_page', type: 'integer', example: 5),
                ],
                type: 'object'
            )
        ),
    ]
)]
class GetProperties
{
    private const PER_PAGE = 20;

    public function __construct(private readonly int $currentPage = 1)
    {
    }

    public function properties(FilterData $filters): LengthAwarePaginator
    {
        $queryParams = array_filter($filters->toArray(), static fn($value) => $value !== null);

        $filterInstances = array_filter(
            array_map(
                static fn($key, $value) => Filters::tryFrom($key)?->createFilter($value),
                array_keys($queryParams),
                $queryParams
            )
        );

        $query = app(Pipeline::class)
            ->send(Property::query())
            ->through($filterInstances)
            ->thenReturn();

        $properties = $query->get();

        return new LengthAwarePaginator(
            $properties->map(fn (Property $property) => PropertyData::from($property)),
            $query->count(),
            self::PER_PAGE,
            $this->currentPage,
            ['path' => route('properties.index')]
        );
    }
}
