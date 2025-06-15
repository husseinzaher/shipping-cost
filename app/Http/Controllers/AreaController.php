<?php

namespace App\Http\Controllers;

use App\Enums\AreaType;
use App\Http\Resources\AreaCollection;
use App\Models\Area;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AreaController
{
    public function index(Request $request): \Illuminate\Http\JsonResponse
    {

        $validated = $request->validate([
            'area_type' => ['required', Rule::enum(AreaType::class)],
        ]);

        $areas = Area::where('type', $validated['area_type'])->get();

        return response()->json([
            AreaCollection::$wrap => AreaCollection::make($areas),
        ]);

    }
}
