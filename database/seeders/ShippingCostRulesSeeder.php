<?php

namespace Database\Seeders;

use App\Enums\AreaType;
use App\Models\ShippingCostRule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class ShippingCostRulesSeeder extends Seeder
{
    public function run(): void
    {
        $commonData = [
            'extra_weight_threshold_kg' => 5,
            'extra_weight_charge_per_kg' => 2.00,
            'fuel_surcharge_percent' => 2.00,
            'packaging_fee' => 5.25,
            'epg_fee_percent' => 10.00,
            'epg_fee_minimum' => 2.00,
            'vat_percent' => 5.00,
            'max_weight_kg' => 20,
            'created_at' => now()->toDateTimeString(),
            'updated_at' => now()->toDateTimeString(),
        ];

        $rules = [
            [
                'shipment_tier_min' => 0,
                'shipment_tier_max' => 250,
                'area_type' => AreaType::Normal->value,
                'base_cost' => 14.00,
            ],
            [
                'shipment_tier_min' => 251,
                'shipment_tier_max' => 500,
                'area_type' => AreaType::Normal->value,
                'base_cost' => 12.00,
            ],
            [
                'shipment_tier_min' => 501,
                'shipment_tier_max' => 9446744073709551615,
                'area_type' => AreaType::Normal->value,
                'base_cost' => 11.00,
            ],
            [
                'shipment_tier_min' => 0,
                'shipment_tier_max' => 250,
                'area_type' => AreaType::Remote->value,
                'base_cost' => 49.00,
            ],
            [
                'shipment_tier_min' => 251,
                'shipment_tier_max' => 500,
                'area_type' => AreaType::Remote->value,
                'base_cost' => 47.00,
            ],
            [
                'shipment_tier_min' => 501,
                'shipment_tier_max' => 9446744073709551615,
                'area_type' => AreaType::Remote->value,
                'base_cost' => 46.00,
            ],
        ];
        $data = Arr::map($rules, function ($rule) use ($commonData) {
            return array_merge($rule, $commonData);
        });

        ShippingCostRule::upsert($data, ['shipment_tier_min', 'shipment_tier_max', 'area_type']);
    }
}
