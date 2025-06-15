<?php

namespace Tests\Feature;

use App\Models\Area;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ShippingApiTest extends TestCase
{


    #[Test]
    public function it_calculates_shipping_cost_successfully(): void
    {
        $payload = [
            'area_type' => 'normal',
            'shipment_count' => 501,
            'weight' => 10,
            'length' => 10,
            'width' => 10,
            'height' => 10,
        ];

        $response = $this->postJson('/api/v1/shipping/cost', $payload);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'prices' => [
                'baseCost',
                'extraWeight',
                'extraWeightCharge',
                'subtotal1',
                'fuel',
                'subtotal2',
                'packaging',
                'subtotal3',
                'epg',
                'subtotal4',
                'vat',
                'total',
            ],
        ]);
    }

    #[Test]
    public function it_returns_area_list_successfully(): void
    {

        $response = $this->getJson('/api/v1/areas?area_type=remote');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'areas' => [
                    '*' => [
                        'id',
                        'city',
                        'area',
                        'type',
                        'created_at',
                        'updated_at',
                    ]
                ]
            ]);
    }

}
