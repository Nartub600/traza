<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Traza extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'type',
        'number',
        'user',
        'division',
        'sector',
        'tag',
        'validation',
        'signature',
        'auth_level',
    ];

    protected $casts = [
        'files' => 'array'
    ];
}
