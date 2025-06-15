<?php

namespace App\Services;

use App\Data\ShippingCalculationResult;
use App\Enums\AreaType;
use App\Exceptions\WeightExceededException;
use App\Models\ShippingCostRule;
use Illuminate\Support\Number;

class ShippingCostService
{
    public function calculate(
        AreaType $areaType,
        int      $shipmentCount,
        float    $weight,
        float    $length,
        float    $width,
        float    $height
    ): ShippingCalculationResult
    {
        $rule = $this->getRuleFor($areaType, $shipmentCount);

        $volumetricWeight = $this->calculateVolumetricWeight($length, $width, $height);
        $usedWeight = $this->getChargeableWeight($weight, $volumetricWeight);

        $this->ensureWithinLimit($usedWeight, $rule->max_weight_kg);

        $baseCost = $rule->base_cost;
        $extraWeightCharge = $this->calculateExtraCharge($usedWeight, $rule);
        $afterExtra = $baseCost + $extraWeightCharge;
        $fuel = $this->calculateFuelSurcharge($afterExtra, $rule);
        $afterFuel = $afterExtra + $fuel;
        $packaging = $rule->packaging_fee;
        $afterPackaging = $afterFuel + $packaging;
        $epg = $this->calculateEpgFee($afterPackaging, $rule);
        $afterEpg = $afterPackaging + $epg;
        $vat = $this->calculateVat($afterEpg, $rule);
        $finalAmount = $afterEpg + $vat;

        return new ShippingCalculationResult(
            $this->formate($baseCost),
            $this->formate(max(0, $usedWeight - $rule->extra_weight_threshold_kg)),
            $this->formate($extraWeightCharge),
            $this->formate($afterExtra),
            $this->formate($fuel),
            $this->formate($afterFuel),
            $this->formate($packaging),
            $this->formate($afterPackaging),
            $this->formate($epg),
            $this->formate($afterEpg),
            $this->formate($vat),
            $this->formate($finalAmount),
        );
    }

    private function getRuleFor(AreaType $areaType, int $count): ShippingCostRule
    {
        return ShippingCostRule::where('area_type', $areaType->value)
            ->where('shipment_tier_min', '<=', $count)
            ->where(function ($q) use ($count) {
                $q->where('shipment_tier_max', '>=', $count)
                    ->orWhereNull('shipment_tier_max');
            })
            ->firstOrFail();
    }

    private function calculateVolumetricWeight(float $length, float $width, float $height): float
    {
        return ($length * $width * $height) / 5000;
    }

    private function getChargeableWeight(float $gross, float $volumetric): float
    {
        return max($gross, $volumetric);
    }

    private function ensureWithinLimit(float $weight, float $max): void
    {
        if ($weight > $max) {
            throw new WeightExceededException($max);
        }
    }

    private function calculateExtraCharge(float $weight, ShippingCostRule $rule): float
    {
        if ($weight <= $rule->extra_weight_threshold_kg) {
            return 0;
        }

        return ($weight - $rule->extra_weight_threshold_kg)
            * $rule->extra_weight_charge_per_kg;
    }

    private function calculateFuelSurcharge(float $subtotal, ShippingCostRule $rule): float
    {
        return $subtotal * ($rule->fuel_surcharge_percent / 100);
    }

    private function calculateEpgFee(float $subtotal, ShippingCostRule $rule): float
    {
        $fee = $subtotal * ($rule->epg_fee_percent / 100);

        return max($fee, $rule->epg_fee_minimum);
    }

    private function calculateVat(float $subtotal, ShippingCostRule $rule): float
    {
        return $subtotal * ($rule->vat_percent / 100);
    }

    private function formate(float $value): string
    {
        return Number::currency($value);
    }
}
