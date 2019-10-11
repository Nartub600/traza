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

    public static function findByCategory($category)
    {
        return (new static)::where('category', $category)->first();
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function getHumanAttribute()
    {
        return $this->category . ' ' . $this->description;
    }
}
