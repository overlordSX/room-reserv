<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Станадартный ресурс
 */
abstract class BaseResource extends JsonResource
{
    public static function collectWithAdditional($resource, $additional): AnonymousResourceCollection
    {
        $collection = static::collection($resource);

        $collection->collection->map(function (JsonResource $item) use ($additional) {
            $item->additional($additional);
        });

        return $collection;
    }
}
