<?php

namespace App\Http\Requests;

use App\Enums\AreaType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * @property string $area_type
 * @property int $shipment_count
 * @property float $weight
 * @property float $length
 * @property float $width
 * @property float $height
 */
class CalculateShippingCostRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'area_type' => ['required', Rule::enum(AreaType::class)],
            'shipment_count' => 'required|integer',
            'weight' => 'required|numeric',
            'length' => 'required|numeric',
            'width' => 'required|numeric',
            'height' => 'required|numeric',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
