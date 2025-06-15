<?php

use App\Http\Controllers\ShippingController;
use Illuminate\Support\Facades\Route;

Route::prefix('v1')->group(function (){
    Route::post('shipping/cost', [ShippingController::class, 'calculateShipping']);
    Route::get('areas', [\App\Http\Controllers\AreaController::class, 'index']);
});

