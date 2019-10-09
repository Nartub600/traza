<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    public static function boot()
    {
        parent::boot();

        static::saving(function ($product) {
            $product->category = $product->category();
        });
    }

    use SoftDeletes;

    protected $fillable = ['name', 'active'];

    protected $casts = [
        'active' => 'boolean'
    ];

    protected $with = ['children'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function parent()
    {
        return $this->belongsTo(Product::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Product::class, 'parent_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function category()
    {
        $tree = [];

        if ($parent = $this->parent) {
            array_unshift($tree, $this->subindex);
            while ($parent->parent) {
                array_unshift($tree, $parent->subindex);
                $parent = $parent->parent;
            }
            array_unshift($tree, $parent->id);
        } else {
            array_unshift($tree, $this->id ?? (Product::doesntHave('parent')->count() + 1));
        }

        return implode('.', $tree);
    }
}
