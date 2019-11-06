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

    public function lcms()
    {
        return $this->hasMany(LCM::class);
    }

    public function autoparts()
    {
        return $this->hasMany(Autopart::class);
    }

    public function items()
    {
        if ($this->lcms->isNotEmpty()) return $this->lcms;
        if ($this->autoparts->isNotEmpty()) return $this->autoparts;

        return [];
    }

    public function getApprovedAttribute()
    {
        if ($this->autoparts->every->hasCHAS()) return true;

        return false;
    }
}
