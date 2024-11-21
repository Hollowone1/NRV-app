<?php

namespace App\Traits;

use Illuminate\Support\Collection;

trait JsonControllerTrait
{
    /**
     *
     * @param Collection $collection
     * @return array
     */
    public function formatJsonResource(Collection $collection): array
    {
        return $collection->map(fn($model) => $model->toFormattedArray())->toArray();
    }
}
