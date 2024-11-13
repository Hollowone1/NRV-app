<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{
    protected $table = 'Artist';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'show_id'
    ];
}
