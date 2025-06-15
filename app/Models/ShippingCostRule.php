<?php

namespace App\Models;

use App\Enums\AreaType;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $shipment_tier_min
 * @property int $shipment_tier_max
 * @property AreaType $area_type
 * @property float $base_cost
 * @property float $extra_weight_threshold_kg
 * @property float $extra_weight_charge_per_kg
 * @property float $fuel_surcharge_percent
 * @property float $packaging_fee
 * @property float $epg_fee_percent
 * @property float $epg_fee_minimum
 * @property float $vat_percent
 * @property float $max_weight_kg
 * @mixin Builder
 */
class ShippingCostRule extends Model
{
    protected $fillable = [
        'shipment_tier_min',
        'shipment_tier_max',
        'area_type',
        'base_cost',
        'extra_weight_threshold_kg',
        'extra_weight_charge_per_kg',
        'fuel_surcharge_percent',
        'packaging_fee',
        'epg_fee_percent',
        'epg_fee_minimum',
        'vat_percent',
        'max_weight_kg',
    ];

    protected $casts = [
        'area_type' => AreaType::class,
    ];
}
