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
        switch ($this->type) {
            case 'chas':
                return $this->autoparts();
            break;
            case 'cape':
                return $this->lcms();
            break;
        }
    }

    public function getApprovedAttribute()
    {
        if ($this->autoparts->every->hasCHAS()) return true;

        return false;
    }
}
