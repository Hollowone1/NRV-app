<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowImage extends Model
{
    protected $table = 'ShowImage';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = ['url', 'showId'];

    /**
     * Formater l'image en tableau.
     */
    public function toFormattedArray(): array
    {
        return [
            'id' => $this->id,
            'url' => $this->url,
        ];
    }
}
