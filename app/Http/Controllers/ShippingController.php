<?php

namespace App\Http\Controllers;

use App\Enums\AreaType;
use App\Http\Requests\CalculateShippingCostRequest;
use App\Services\ShippingCostService;

class ShippingController
{
    /**
     * @throws \Exception
     */
    public function calculateShipping(CalculateShippingCostRequest $request)
    {

        $calculator = new ShippingCostService;
        $result = $calculator->calculate(
            $request->enum('area_type', AreaType::class),
            $request->validated('shipment_count'),
            $request->validated('weight'),
            $request->validated('length'),
            $request->validated('width'),
            $request->validated('height'),
        );

        return response()->json([
            'prices' => $result->toArray(),
        ]);

    }
}
