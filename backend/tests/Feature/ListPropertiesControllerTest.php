<?php

namespace Tests\Feature;

use App\Models\Property;
use App\ViewModels\GetProperties;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ListPropertiesControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        Property::factory()
            ->count(100)
            ->create();
    }

    public function test_index_returns_200(): void
    {
        $response = $this->getJson(route('properties.index'));
        $response->assertStatus(200)->assertJsonStructure(['data', 'links']);
        $responseData = $response->json();
        $this->assertCount(GetProperties::PER_PAGE, $responseData['data']);
    }
}
