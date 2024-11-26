<?php

namespace App\Traits;

trait JsonSerializableTrait
{
    
    public function toFormattedArray(): array
{
    $formatted = $this->attributesToArray();

    if (property_exists($this, 'relationsToInclude')) {
        foreach ($this->relationsToInclude as $relation) {
            if ($this->relationLoaded($relation) && is_iterable($this->$relation)) {
                $formatted[$relation] = $this->$relation->map(fn($item) => $item->toFormattedArray())->toArray();
            } else {
                // Gérer le cas où la relation n'est pas chargée ou n'est pas itérable
                $formatted[$relation] = null;
            }
        }
    }

    return $formatted;
}


    
    public function toJson($options = 0): string
    {
        return json_encode($this->toFormattedArray(), $options);
    }
}
