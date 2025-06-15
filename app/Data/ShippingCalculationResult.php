<?php

namespace App\Data;

use Spatie\LaravelData\Data;

class ShippingCalculationResult extends Data
{
    public function __construct(
        public string $baseCost,
        public string $extraWeight,
        public string $extraWeightCharge,
        public string $subtotal1,
        public string $fuel,
        public string $subtotal2,
        public string $packaging,
        public string $subtotal3,
        public string $epg,
        public string $subtotal4,
        public string $vat,
        public string $total,
    ) {}
}
