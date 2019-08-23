<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'family', 'active', 'picture'];

    protected $casts = [
        'active' => 'boolean'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
