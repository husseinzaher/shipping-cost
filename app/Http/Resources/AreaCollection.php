<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AreaCollection extends ResourceCollection
{
    public $resource = AreaResource::class;

    public static $wrap = 'areas';
}
