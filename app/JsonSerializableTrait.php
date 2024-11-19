<?php

namespace App\Traits;

trait JsonSerializableTrait
{
    
    public function toFormattedArray(): array
    {
        $formatted = $this->attributesToArray();

        
        if (property_exists($this, 'relationsToInclude')) {
            foreach ($this->relationsToInclude as $relation) {
                if ($this->relationLoaded($relation)) {
                    $formatted[$relation] = $this->$relation->map(fn($item) => $item->toFormattedArray())->toArray();
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
