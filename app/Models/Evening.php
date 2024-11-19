<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evening extends Model
{
    // Nom de la table
    protected $table = 'Evening';

    // Clé primaire
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;

    // Désactive les timestamps automatiques si non utilisés
    public $timestamps = false;

    // Colonnes pouvant être remplies via $fillable
    protected $fillable = ['name', 'thematic', 'date', 'price', 'reducedPrice', 'spotId'];

    /**
     * Relation avec le spot (un spot par soirée)
     */
    public function spot()
    {
        return $this->belongsTo(Spot::class, 'spotId');
    }

    /**
     * Relation avec les shows (plusieurs shows par soirée)
     */
    public function shows()
    {
        return $this->hasMany(Show::class, 'eveningId');
    }

    /**
     * Formater la soirée en tableau (remplace le DTO).
     */
    public function toFormattedArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'thematic' => $this->thematic,
            'date' => $this->date,
            'price' => $this->price,
            'reducedPrice' => $this->reducedPrice,
            'spot' => $this->spot ? $this->spot->toFormattedArray() : null,
            'shows' => $this->shows->map(fn($show) => $show->toFormattedArray())->toArray(),
        ];
    }
}
