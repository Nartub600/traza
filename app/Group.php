<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = ['name', 'active'];

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
