<?php

namespace App\Exceptions;

use RuntimeException;

class WeightExceededException extends RuntimeException
{
    public function __construct(float $maxWeight)
    {
        parent::__construct(
            "Weight exceeds maximum allowed ({$maxWeight} kg)."
        );
    }
}
