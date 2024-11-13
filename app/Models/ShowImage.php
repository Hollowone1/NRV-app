<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShowImage extends Model
{
    protected $table = 'ShowImage';
    protected $primaryKey = 'id';

    protected $fillable = [
        'path',
        'showId',
    ];
}
