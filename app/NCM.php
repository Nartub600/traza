<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NCM extends Model
{
    use SoftDeletes;

    protected $table = 'ncm';

    protected $fillable = ['category', 'description', 'active'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }
}
